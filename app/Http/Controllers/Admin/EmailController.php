<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Vendor;
use App\Models\CommunicationLog;
use App\Models\EmailAttachment;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class EmailController extends Controller
{
    /**
     * Upload attachment file via AJAX
     */
    public function uploadAttachment(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240', // 10MB max
            'temp_id' => 'required|string'
        ]);

        try {
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $mimeType = $file->getMimeType();
            $fileSize = $file->getSize();
            
            // Generate unique filename
            $storedName = Str::random(40) . '.' . $extension;
            
            // Store in temp directory first
            $path = $file->storeAs('temp/email-attachments', $storedName, 'local');
            
            return response()->json([
                'success' => true,
                'file_info' => [
                    'temp_id' => $request->temp_id,
                    'original_name' => $originalName,
                    'stored_name' => $storedName,
                    'path' => $path,
                    'mime_type' => $mimeType,
                    'size' => $fileSize,
                    'formatted_size' => $this->formatFileSize($fileSize)
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('File upload error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to upload file: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Send email to client with attachments
     */
    public function sendToClient(Request $request, Client $client)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'attachments' => 'nullable|array',
            'attachments.*' => 'array'
        ]);

        try {
            // Create communication log entry
            $communicationLog = CommunicationLog::create([
                'entity_type' => 'client',
                'entity_id' => $client->id,
                'admin_user_id' => Auth::id(),
                'subject' => $request->subject,
                'message_preview' => Str::limit($request->message, 200),
                'status' => 'sending',
                'sent_at' => now(),
            ]);

            // Process attachments
            $attachmentPaths = [];
            if ($request->has('attachments') && is_array($request->attachments)) {
                foreach ($request->attachments as $attachmentInfo) {
                    if (isset($attachmentInfo['path']) && Storage::disk('local')->exists($attachmentInfo['path'])) {
                        // Move from temp to permanent location
                        $permanentPath = 'email-attachments/' . $communicationLog->id . '/' . $attachmentInfo['stored_name'];
                        Storage::disk('local')->move($attachmentInfo['path'], $permanentPath);
                        
                        // Save attachment record
                        EmailAttachment::create([
                            'communication_log_id' => $communicationLog->id,
                            'original_filename' => $attachmentInfo['original_name'],
                            'stored_filename' => $attachmentInfo['stored_name'],
                            'file_path' => $permanentPath,
                            'mime_type' => $attachmentInfo['mime_type'],
                            'file_size' => $attachmentInfo['size'],
                        ]);
                        
                        $attachmentPaths[] = [
                            'path' => storage_path('app/' . $permanentPath),
                            'name' => $attachmentInfo['original_name'],
                            'mime' => $attachmentInfo['mime_type']
                        ];
                    }
                }
            }

            // Send email with attachments
            Mail::send('emails.admin-to-client', [
                'client' => $client,
                'subject' => $request->subject,
                'messageContent' => $request->message,
                'admin' => Auth::user()
            ], function ($message) use ($client, $request, $attachmentPaths) {
                $message->to($client->email, $client->full_name)
                        ->subject($request->subject);
                
                // Add attachments
                foreach ($attachmentPaths as $attachment) {
                    $message->attach($attachment['path'], [
                        'as' => $attachment['name'],
                        'mime' => $attachment['mime']
                    ]);
                }
            });

            // Update communication log status
            $communicationLog->update(['status' => 'sent']);

            return response()->json([
                'success' => true,
                'message' => 'Email sent successfully to ' . $client->full_name
            ]);

        } catch (\Exception $e) {
            Log::error('Email sending error: ' . $e->getMessage());
            
            // Update status to failed if communication log was created
            if (isset($communicationLog)) {
                $communicationLog->update(['status' => 'failed']);
            }
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to send email: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Send email to vendor with attachments
     */
    public function sendToVendor(Request $request, Vendor $vendor)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'attachments' => 'nullable|array',
            'attachments.*' => 'array'
        ]);

        try {
            // Create communication log entry
            $communicationLog = CommunicationLog::create([
                'entity_type' => 'vendor',
                'entity_id' => $vendor->id,
                'admin_user_id' => Auth::id(),
                'subject' => $request->subject,
                'message_preview' => Str::limit($request->message, 200),
                'status' => 'sending',
                'sent_at' => now(),
            ]);

            // Process attachments
            $attachmentPaths = [];
            if ($request->has('attachments') && is_array($request->attachments)) {
                foreach ($request->attachments as $attachmentInfo) {
                    if (isset($attachmentInfo['path']) && Storage::disk('local')->exists($attachmentInfo['path'])) {
                        // Move from temp to permanent location
                        $permanentPath = 'email-attachments/' . $communicationLog->id . '/' . $attachmentInfo['stored_name'];
                        Storage::disk('local')->move($attachmentInfo['path'], $permanentPath);
                        
                        // Save attachment record
                        EmailAttachment::create([
                            'communication_log_id' => $communicationLog->id,
                            'original_filename' => $attachmentInfo['original_name'],
                            'stored_filename' => $attachmentInfo['stored_name'],
                            'file_path' => $permanentPath,
                            'mime_type' => $attachmentInfo['mime_type'],
                            'file_size' => $attachmentInfo['size'],
                        ]);
                        
                        $attachmentPaths[] = [
                            'path' => storage_path('app/' . $permanentPath),
                            'name' => $attachmentInfo['original_name'],
                            'mime' => $attachmentInfo['mime_type']
                        ];
                    }
                }
            }

            // Send email with attachments
            Mail::send('emails.admin-to-vendor', [
                'vendor' => $vendor,
                'subject' => $request->subject,
                'messageContent' => $request->message,
                'admin' => Auth::user()
            ], function ($message) use ($vendor, $request, $attachmentPaths) {
                $message->to($vendor->contact_email, $vendor->first_name . ' ' . $vendor->last_name)
                        ->subject($request->subject);
                
                // Add attachments
                foreach ($attachmentPaths as $attachment) {
                    $message->attach($attachment['path'], [
                        'as' => $attachment['name'],
                        'mime' => $attachment['mime']
                    ]);
                }
            });

            // Update communication log status
            $communicationLog->update(['status' => 'sent']);

            return response()->json([
                'success' => true,
                'message' => 'Email sent successfully to ' . $vendor->first_name . ' ' . $vendor->last_name
            ]);

        } catch (\Exception $e) {
            Log::error('Email sending error: ' . $e->getMessage());
            
            // Update status to failed if communication log was created
            if (isset($communicationLog)) {
                $communicationLog->update(['status' => 'failed']);
            }
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to send email: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Format file size for display
     */
    private function formatFileSize($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }
}
