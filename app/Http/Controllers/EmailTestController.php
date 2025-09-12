<?php

namespace App\Http\Controllers;

use App\Mail\TestEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Exception;

class EmailTestController extends Controller
{
    /**
     * Show the email test form
     */
    public function showTestForm()
    {
        return view('admin.email-test');
    }

    /**
     * Send a test email
     */
    public function sendTestEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'name' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $testData = [
                'recipient_name' => $request->name ?: 'Test User',
                'message' => 'This is a test email to verify Sky Land Construction email configuration. If you receive this email, your SMTP settings are working correctly!',
                'timestamp' => now()->format('Y-m-d H:i:s'),
            ];

            Mail::to($request->email)->send(new TestEmail($testData));

            return response()->json([
                'success' => true,
                'message' => 'Test email sent successfully to ' . $request->email,
                'data' => [
                    'email' => $request->email,
                    'name' => $testData['recipient_name'],
                    'sent_at' => $testData['timestamp']
                ]
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send test email',
                'error' => $e->getMessage(),
                'debug_info' => [
                    'smtp_host' => config('mail.mailers.smtp.host'),
                    'smtp_port' => config('mail.mailers.smtp.port'),
                    'smtp_username' => config('mail.mailers.smtp.username'),
                    'from_address' => config('mail.from.address'),
                ]
            ], 500);
        }
    }

    /**
     * Test SMTP connection without sending email
     */
    public function testConnection()
    {
        try {
            $transport = Mail::getSwiftMailer()->getTransport();
            
            if (method_exists($transport, 'start')) {
                $transport->start();
            }

            return response()->json([
                'success' => true,
                'message' => 'SMTP connection successful',
                'config' => [
                    'host' => config('mail.mailers.smtp.host'),
                    'port' => config('mail.mailers.smtp.port'),
                    'encryption' => config('mail.mailers.smtp.encryption'),
                    'username' => config('mail.mailers.smtp.username'),
                    'from_address' => config('mail.from.address'),
                ]
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'SMTP connection failed',
                'error' => $e->getMessage(),
                'config' => [
                    'host' => config('mail.mailers.smtp.host'),
                    'port' => config('mail.mailers.smtp.port'),
                    'encryption' => config('mail.mailers.smtp.encryption'),
                    'username' => config('mail.mailers.smtp.username'),
                ]
            ], 500);
        }
    }
}
