<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatConversation;
use App\Models\ChatMessage;
use App\Models\ChatAttachment;
use App\Models\Client;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ChatController extends Controller
{
    // Middleware will be applied via routes instead of constructor

    /**
     * Show chat interface
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Get conversations based on user type
        if ($user->isAdmin()) {
            $conversations = ChatConversation::with(['client', 'vendor', 'lastMessageBy'])
                ->active()
                ->orderBy('last_message_at', 'desc')
                ->get();
        } else {
            // For clients/vendors, only show their own conversation if approved
            if ($user->isClient()) {
                $entityType = 'client';
                $entityId = $user->client_id;
                $entity = Client::find($entityId);
            } elseif ($user->isSupplier()) {
                $entityType = 'vendor';
                $entityId = $user->supplier_id;
                $entity = Vendor::find($entityId);
            } else {
                // User is not linked to any entity
                return view('chat.not-approved');
            }
            
            if (!$entity || $entity->status !== 'approved') {
                return view('chat.not-approved');
            }
            
            $conversations = ChatConversation::with(['client', 'vendor', 'lastMessageBy'])
                ->where('entity_type', $entityType)
                ->where('entity_id', $entityId)
                ->active()
                ->get();
        }
        
        $activeConversation = null;
        if ($request->has('conversation') && $conversations->count() > 0) {
            $activeConversation = $conversations->firstWhere('id', $request->conversation);
        } elseif ($conversations->count() > 0) {
            $activeConversation = $conversations->first();
        }
        
        return view('chat.index', compact('conversations', 'activeConversation', 'user'));
    }

    /**
     * Get conversation messages
     */
    public function getMessages(ChatConversation $conversation)
    {
        $user = Auth::user();
        
        // Check access permissions
        if (!$this->canAccessConversation($user, $conversation)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        $messages = $conversation->messages()
            ->with(['sender', 'attachments'])
            ->orderBy('created_at', 'asc')
            ->take(50)
            ->get();
        
        // Mark as read
        $userType = $user->isAdmin() ? 'admin' : 'client';
        $conversation->markAsRead($userType);
        
        return response()->json([
            'messages' => $messages,
            'conversation' => $conversation
        ]);
    }

    /**
     * Send a message
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'conversation_id' => 'nullable|exists:chat_conversations,id',
            'entity_type' => 'required_without:conversation_id|in:client,vendor',
            'entity_id' => 'required_without:conversation_id|integer',
            'message' => 'required|string|max:2000',
            'attachments' => 'nullable|array',
            'attachments.*' => 'array'
        ]);

        $user = Auth::user();
        
        // Get or create conversation
        if ($request->conversation_id) {
            $conversation = ChatConversation::findOrFail($request->conversation_id);
        } else {
            // Admin starting new conversation - auto-approve entity
            if ($user->isAdmin()) {
                $entity = $request->entity_type === 'client' 
                    ? Client::findOrFail($request->entity_id)
                    : Vendor::findOrFail($request->entity_id);
                
                // Auto-approve entity when admin starts chat
                if ($entity->status !== 'approved') {
                    $entity->update([
                        'status' => 'approved',
                        'status_updated_at' => now(),
                        'status_updated_by' => $user->id,
                        'status_reason' => 'Auto-approved when admin initiated chat'
                    ]);
                }
            }
            
            $conversation = ChatConversation::firstOrCreate([
                'entity_type' => $request->entity_type,
                'entity_id' => $request->entity_id,
            ], [
                'status' => 'active',
                'title' => null,
            ]);
        }
        
        // Check access
        if (!$this->canAccessConversation($user, $conversation)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        // Create message
        $message = ChatMessage::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $user->id,
            'message' => $request->message,
            'message_type' => 'text',
        ]);
        
        // Handle attachments
        if ($request->has('attachments') && is_array($request->attachments)) {
            foreach ($request->attachments as $attachmentInfo) {
                if (isset($attachmentInfo['path']) && Storage::disk('local')->exists($attachmentInfo['path'])) {
                    // Move from temp to permanent location
                    $permanentPath = 'chat-attachments/' . $conversation->id . '/' . $attachmentInfo['stored_name'];
                    Storage::disk('local')->move($attachmentInfo['path'], $permanentPath);
                    
                    // Save attachment record
                    ChatAttachment::create([
                        'message_id' => $message->id,
                        'original_filename' => $attachmentInfo['original_name'],
                        'stored_filename' => $attachmentInfo['stored_name'],
                        'file_path' => $permanentPath,
                        'mime_type' => $attachmentInfo['mime_type'],
                        'file_size' => $attachmentInfo['size'],
                    ]);
                }
            }
        }
        
        // Update conversation
        $conversation->update([
            'last_message_at' => now(),
            'last_message_by' => $user->id,
            'last_message_preview' => $message->getPreview(),
        ]);
        
        // Increment unread count for the other party
        $recipientType = $user->isAdmin() ? 'client' : 'admin';
        $conversation->incrementUnreadCount($recipientType);
        
        // Send email notification (async - don't block chat)
        try {
            $this->sendMessageNotification($conversation, $message);
        } catch (\Exception $e) {
            // Log error but don't break chat functionality
            Log::error('Email notification failed: ' . $e->getMessage());
        }
        
        return response()->json([
            'success' => true,
            'message' => $message->load(['sender', 'attachments'])
        ]);
    }

    /**
     * Check if user can access conversation
     */
    private function canAccessConversation($user, $conversation)
    {
        if ($user->isAdmin()) {
            return true;
        }
        
        if ($user->isClient() && $user->client_id) {
            $entityType = 'client';
            $entityId = $user->client_id;
        } elseif ($user->isSupplier() && $user->supplier_id) {
            $entityType = 'vendor';
            $entityId = $user->supplier_id;
        } else {
            return false; // User not properly linked to entity
        }
        
        return $conversation->entity_type === $entityType && $conversation->entity_id === $entityId;
    }

    /**
     * Upload attachment temporarily
     */
    public function uploadAttachment(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240', // 10MB max
        ]);

        try {
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $mimeType = $file->getMimeType();
            $size = $file->getSize();
            
            // Generate unique filename
            $storedName = Str::random(40) . '.' . $file->getClientOriginalExtension();
            
            // Store in temp location
            $tempPath = 'temp-attachments/' . $storedName;
            $path = $file->storeAs('temp-attachments', $storedName, 'local');
            
            return response()->json([
                'success' => true,
                'original_name' => $originalName,
                'stored_name' => $storedName,
                'path' => $path,
                'mime_type' => $mimeType,
                'size' => $size
            ]);
        } catch (\Exception $e) {
            Log::error('File upload failed: ' . $e->getMessage());
            return response()->json(['error' => 'Upload failed'], 500);
        }
    }

    /**
     * Download attachment
     */
    public function downloadAttachment(ChatAttachment $attachment)
    {
        $user = Auth::user();
        
        // Check if user can access this attachment
        if (!$this->canAccessConversation($user, $attachment->message->conversation)) {
            abort(403);
        }
        
        if (!$attachment->fileExists()) {
            abort(404);
        }
        
        return response()->download($attachment->full_path, $attachment->original_filename);
    }

    /**
     * Edit message
     */
    public function editMessage(Request $request, ChatMessage $message)
    {
        $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        $user = Auth::user();
        
        // Check if user can edit this message (only sender can edit)
        if ($message->sender_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        // Check if message is not too old (e.g., 5 minutes)
        if ($message->created_at->diffInMinutes(now()) > 5) {
            return response()->json(['error' => 'Message too old to edit'], 403);
        }
        
        $message->update([
            'message' => $request->message,
            'is_edited' => true,
            'edited_at' => now(),
        ]);
        
        return response()->json([
            'success' => true,
            'message' => $message->load(['sender', 'attachments'])
        ]);
    }

    /**
     * Mark conversation as read
     */
    public function markAsRead(ChatConversation $conversation)
    {
        $user = Auth::user();
        
        if (!$this->canAccessConversation($user, $conversation)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        $userType = $user->isAdmin() ? 'admin' : 'client';
        $conversation->markAsRead($userType);
        
        return response()->json(['success' => true]);
    }

    /**
     * Get entities for new chat modal (Admin only)
     */
    public function getEntities(Request $request)
    {
        $user = Auth::user();
        
        Log::info('getEntities called', [
            'user_id' => $user->id,
            'is_admin' => $user->isAdmin(),
            'type' => $request->get('type')
        ]);
        
        if (!$user->isAdmin()) {
            Log::warning('Non-admin user tried to access entities', ['user_id' => $user->id]);
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        $type = $request->get('type');
        
        if ($type === 'client') {
            $entities = Client::select('id', 'full_name', 'email', 'status')->get();
            Log::info('Retrieved clients', ['count' => $entities->count()]);
            return response()->json($entities);
        } elseif ($type === 'vendor') {
            $entities = Vendor::select('id', 'company_name', 'contact_email', 'status')->get();
            Log::info('Retrieved vendors', ['count' => $entities->count()]);
            return response()->json($entities);
        }
        
        Log::error('Invalid type requested', ['type' => $type]);
        return response()->json(['error' => 'Invalid type'], 400);
    }

    /**
     * Send message notification email
     */
    private function sendMessageNotification($conversation, $message)
    {
        try {
            $sender = $message->sender;
            $entity = $conversation->getEntity();
            
            if ($sender->isAdmin()) {
                // Admin sent message to client/vendor
                $recipientEmail = $conversation->entity_type === 'client' 
                    ? $entity->email 
                    : $entity->contact_email;
                
                // Send notification email
                Mail::to($recipientEmail)->send(new \App\Mail\ChatMessageNotification($conversation, $message));
            } else {
                // Client/vendor sent message to admin
                $adminUsers = \App\Models\User::where('is_admin', true)->get();
                foreach ($adminUsers as $admin) {
                    Mail::to($admin->email)->send(new \App\Mail\ChatMessageNotification($conversation, $message));
                }
            }
        } catch (\Exception $e) {
            Log::error('Failed to send chat notification: ' . $e->getMessage());
        }
    }
}
