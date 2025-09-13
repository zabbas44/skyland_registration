<?php

namespace App\Http\Controllers;

use App\Models\EmailConversation;
use App\Models\Client;
use App\Models\Vendor;
use App\Models\User;
use App\Mail\EmailConversationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class EmailConversationController extends Controller
{
    /**
     * Display email conversations interface
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            // Admin sees all conversations
            $conversations = EmailConversation::with(['client', 'vendor'])
                ->orderBy('created_at', 'desc')
                ->get();
            
            return view('email-conversations.admin', compact('conversations', 'user'));
        } else {
            // Client/Vendor sees their own conversations
            if ($user->isClient()) {
                $conversations = EmailConversation::where('client_id', $user->client_id)
                    ->orderBy('created_at', 'desc')
                    ->get();
            } elseif ($user->isSupplier()) {
                $conversations = EmailConversation::where('vendor_id', $user->supplier_id)
                    ->orderBy('created_at', 'desc')
                    ->get();
            } else {
                $conversations = collect();
            }
            
            return view('email-conversations.client', compact('conversations', 'user'));
        }
    }

    /**
     * Send new email from admin to client/vendor
     */
    public function sendFromAdmin(Request $request)
    {
        $user = Auth::user();
        
        if (!$user->isAdmin()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'entity_type' => 'required|in:client,vendor',
            'entity_id' => 'required|integer',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'attachments.*' => 'file|max:10240' // 10MB max per file
        ]);

        try {
            // Handle file attachments
            $attachments = [];
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $path = $file->store('email-attachments', 'private');
                    $attachments[] = [
                        'original_name' => $file->getClientOriginalName(),
                        'path' => $path,
                        'size' => $file->getSize(),
                        'type' => $file->getMimeType()
                    ];
                }
            }

            // Create email conversation
            $data = [
                'subject' => $request->subject,
                'admin_message' => $request->message,
                'admin_sent_at' => now(),
                'admin_attachments' => $attachments,
                'status' => 'pending_reply'
            ];

            if ($request->entity_type === 'client') {
                $data['client_id'] = $request->entity_id;
                $entity = Client::find($request->entity_id);
            } else {
                $data['vendor_id'] = $request->entity_id;
                $entity = Vendor::find($request->entity_id);
            }

            if (!$entity) {
                return response()->json(['error' => 'Entity not found'], 404);
            }

            $conversation = EmailConversation::create($data);

            // Send email notification
            $this->sendEmailNotification($conversation, 'admin_to_client');

            return response()->json([
                'success' => true,
                'message' => 'Email sent successfully',
                'conversation' => $conversation->load(['client', 'vendor'])
            ]);

        } catch (\Exception $e) {
            Log::error('Email sending failed: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to send email'], 500);
        }
    }

    /**
     * Reply from client/vendor
     */
    public function reply(Request $request, EmailConversation $conversation)
    {
        $user = Auth::user();
        
        // Check if user can reply to this conversation
        if (!$this->canUserAccessConversation($user, $conversation)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'reply' => 'required|string',
            'attachments.*' => 'file|max:10240' // 10MB max per file
        ]);

        try {
            // Handle file attachments
            $attachments = [];
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $path = $file->store('email-attachments', 'private');
                    $attachments[] = [
                        'original_name' => $file->getClientOriginalName(),
                        'path' => $path,
                        'size' => $file->getSize(),
                        'type' => $file->getMimeType()
                    ];
                }
            }

            // Update conversation with reply
            $conversation->update([
                'client_reply' => $request->reply,
                'client_replied_at' => now(),
                'client_attachments' => $attachments,
                'status' => 'replied',
                'admin_read' => false // Mark as unread for admin
            ]);

            // Send email notification to admin
            $this->sendEmailNotification($conversation, 'client_to_admin');

            return response()->json([
                'success' => true,
                'message' => 'Reply sent successfully',
                'conversation' => $conversation->fresh()
            ]);

        } catch (\Exception $e) {
            Log::error('Reply sending failed: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to send reply'], 500);
        }
    }

    /**
     * Mark conversation as read
     */
    public function markAsRead(EmailConversation $conversation)
    {
        $user = Auth::user();
        
        if (!$this->canUserAccessConversation($user, $conversation)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        if ($user->isAdmin()) {
            $conversation->markAsReadByAdmin();
        } else {
            $conversation->markAsReadByClient();
        }

        return response()->json(['success' => true]);
    }

    /**
     * Download attachment
     */
    public function downloadAttachment(EmailConversation $conversation, $type, $index)
    {
        $user = Auth::user();
        
        if (!$this->canUserAccessConversation($user, $conversation)) {
            abort(403, 'Unauthorized');
        }

        $attachments = $type === 'admin' ? $conversation->admin_attachments : $conversation->client_attachments;
        
        if (!$attachments || !isset($attachments[$index])) {
            abort(404, 'Attachment not found');
        }

        $attachment = $attachments[$index];
        $filePath = $attachment['path'];

        if (!Storage::disk('private')->exists($filePath)) {
            abort(404, 'File not found');
        }

        return Storage::disk('private')->download($filePath, $attachment['original_name']);
    }

    /**
     * Get entities for admin (clients and vendors)
     */
    public function getEntities()
    {
        $user = Auth::user();
        
        if (!$user->isAdmin()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $clients = Client::select('id', 'name', 'email', 'status')->get()->map(function ($client) {
            return [
                'id' => $client->id,
                'name' => $client->name,
                'email' => $client->email,
                'status' => $client->status,
                'type' => 'client'
            ];
        });

        $vendors = Vendor::select('id', 'name', 'email', 'status')->get()->map(function ($vendor) {
            return [
                'id' => $vendor->id,
                'name' => $vendor->name,
                'email' => $vendor->email,
                'status' => $vendor->status,
                'type' => 'vendor'
            ];
        });

        return response()->json([
            'clients' => $clients,
            'vendors' => $vendors
        ]);
    }

    /**
     * Check if user can access conversation
     */
    private function canUserAccessConversation(User $user, EmailConversation $conversation)
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isClient() && $conversation->client_id === $user->client_id) {
            return true;
        }

        if ($user->isSupplier() && $conversation->vendor_id === $user->supplier_id) {
            return true;
        }

        return false;
    }

    /**
     * Send email notification
     */
    private function sendEmailNotification(EmailConversation $conversation, $type)
    {
        try {
            if ($type === 'admin_to_client') {
                // Send to client/vendor
                $entity = $conversation->getEntity();
                if ($entity && $entity->email) {
                    Mail::to($entity->email)->send(new EmailConversationNotification($conversation, 'new_message'));
                }
            } elseif ($type === 'client_to_admin') {
                // Send to admin
                $adminUsers = User::where('is_admin', true)->get();
                foreach ($adminUsers as $admin) {
                    Mail::to($admin->email)->send(new EmailConversationNotification($conversation, 'reply_received'));
                }
            }
        } catch (\Exception $e) {
            Log::error('Email notification failed: ' . $e->getMessage());
            // Don't throw exception - email conversation should still work
        }
    }
}