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
    /**
     * Show conversation interface
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
                return view('conversations.not-approved');
            }
            
            if (!$entity || $entity->status !== 'approved') {
                return view('conversations.not-approved');
            }
            
            $conversations = ChatConversation::with(['client', 'vendor', 'lastMessageBy'])
                ->where('entity_type', $entityType)
                ->where('entity_id', $entityId)
                ->active()
                ->get();
        }
        
        $activeConversation = null;
        if ($request->has('conversation') && $conversations->count() > 0) {
            $activeConversation = $conversations->where('id', $request->conversation)->first();
        } elseif ($conversations->count() > 0) {
            $activeConversation = $conversations->first();
        }
        
        return view('conversations.index', compact('conversations', 'activeConversation', 'user'));
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
        $user = Auth::user();
        
        $request->validate([
            'message' => 'required|string|max:5000',
            'conversation_id' => 'nullable|exists:chat_conversations,id',
            'create_new' => 'boolean'
        ]);

        try {
            // If creating new conversation or no conversation specified
            if ($request->create_new || !$request->conversation_id) {
                $conversation = $this->createOrGetConversation($user);
            } else {
                $conversation = ChatConversation::findOrFail($request->conversation_id);
                
                // Check access permissions
                if (!$this->canAccessConversation($user, $conversation)) {
                    return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
                }
            }

            // Create the message
            $message = ChatMessage::create([
                'conversation_id' => $conversation->id,
                'sender_id' => $user->id,
                'message' => $request->message,
                'message_type' => 'text'
            ]);

            // Update conversation
            $conversation->update([
                'last_message_at' => now(),
                'last_message_by' => $user->id,
                'last_message_preview' => \Str::limit($request->message, 100)
            ]);

            // Increment unread count for the other party
            if ($user->isAdmin()) {
                $conversation->increment('unread_count_client');
            } else {
                $conversation->increment('unread_count_admin');
            }

            // Send notification (optional - implement later)
            // $this->sendMessageNotification($conversation, $message);

            return response()->json([
                'success' => true,
                'message' => $message->load('sender'),
                'conversation' => $conversation
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to send message: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to send message: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mark conversation as read
     */
    public function markAsRead(ChatConversation $conversation)
    {
        $user = Auth::user();
        
        // Check access permissions
        if (!$this->canAccessConversation($user, $conversation)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $userType = $user->isAdmin() ? 'admin' : 'client';
        $conversation->markAsRead($userType);

        return response()->json(['success' => true]);
    }

    /**
     * Upload attachment
     */
    public function uploadAttachment(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240', // 10MB max
            'conversation_id' => 'required|exists:chat_conversations,id'
        ]);

        $user = Auth::user();
        $conversation = ChatConversation::findOrFail($request->conversation_id);
        
        // Check access permissions
        if (!$this->canAccessConversation($user, $conversation)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        try {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('conversation-attachments', $filename, 'private');

            // Create attachment record (implement ChatAttachment model if needed)
            // For now, we'll store it as metadata in the message
            $message = ChatMessage::create([
                'conversation_id' => $conversation->id,
                'sender_id' => $user->id,
                'message' => 'File: ' . $file->getClientOriginalName(),
                'message_type' => 'file',
                'metadata' => [
                    'filename' => $file->getClientOriginalName(),
                    'path' => $path,
                    'size' => $file->getSize(),
                    'mime_type' => $file->getMimeType()
                ]
            ]);

            return response()->json([
                'success' => true,
                'message' => $message->load('sender')
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to upload attachment: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to upload file'
            ], 500);
        }
    }

    /**
     * Create or get existing conversation for user
     */
    private function createOrGetConversation($user)
    {
        if ($user->isAdmin()) {
            throw new \Exception('Admin cannot create conversations from this endpoint');
        }

        // Determine entity type and ID
        if ($user->isClient()) {
            $entityType = 'client';
            $entityId = $user->client_id;
        } elseif ($user->isSupplier()) {
            $entityType = 'vendor';
            $entityId = $user->supplier_id;
        } else {
            throw new \Exception('User not linked to any entity');
        }

        // Check if conversation already exists
        $conversation = ChatConversation::where('entity_type', $entityType)
            ->where('entity_id', $entityId)
            ->first();

        if (!$conversation) {
            // Create new conversation
            $conversation = ChatConversation::create([
                'entity_type' => $entityType,
                'entity_id' => $entityId,
                'title' => 'Conversation with Admin',
                'status' => 'active'
            ]);
        }

        return $conversation;
    }

    /**
     * Check if user can access conversation
     */
    private function canAccessConversation($user, $conversation)
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isClient() && $conversation->entity_type === 'client' && $conversation->entity_id == $user->client_id) {
            return true;
        }

        if ($user->isSupplier() && $conversation->entity_type === 'vendor' && $conversation->entity_id == $user->supplier_id) {
            return true;
        }

        return false;
    }
}