<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\EmailConversation;
use App\Models\Client;
use App\Models\Vendor;
use App\Models\User;
use App\Mail\EmailConversationNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class TestEmailConversations extends Command
{
    protected $signature = 'test:email-conversations';
    protected $description = 'Test email conversation notifications';

    public function handle()
    {
        $this->info('🧪 Testing Email Conversation System...');
        
        // Test 1: Check if we have test data
        $this->info('📊 Checking test data...');
        
        $clients = Client::limit(3)->get();
        $vendors = Vendor::limit(3)->get();
        $admins = User::where('is_admin', true)->limit(3)->get();
        
        $this->info("Found {$clients->count()} clients, {$vendors->count()} vendors, {$admins->count()} admins");
        
        if ($clients->isEmpty()) {
            $this->warn('⚠️  No clients found! Creating test client...');
            $client = Client::create([
                'full_name' => 'Test Client',
                'email' => 'testclient@example.com',
                'status' => 'approved',
                'client_type' => 'individual',
                'mobile' => '1234567890',
                'address' => 'Test Address'
            ]);
            $clients = collect([$client]);
        }
        
        if ($admins->isEmpty()) {
            $this->warn('⚠️  No admin users found! Creating test admin...');
            $admin = User::create([
                'name' => 'Test Admin',
                'email' => 'testadmin@example.com',
                'password' => bcrypt('password'),
                'is_admin' => true,
                'user_type' => 'admin'
            ]);
            $admins = collect([$admin]);
        }
        
        // Test 2: Create a test email conversation
        $this->info('📧 Creating test email conversation...');
        
        $client = $clients->first();
        $admin = $admins->first();
        
        $conversation = EmailConversation::create([
            'client_id' => $client->id,
            'subject' => 'Test Email Conversation - ' . now()->format('Y-m-d H:i:s'),
            'admin_message' => 'Hello! This is a test message from the admin to verify our email notification system is working properly.',
            'admin_sent_at' => now(),
            'status' => 'pending_reply',
            'admin_read' => true,
            'client_read' => false
        ]);
        
        $this->info("✅ Created conversation #{$conversation->id}");
        
        // Test 3: Test admin-to-client notification
        $this->info('📤 Testing admin-to-client email notification...');
        
        try {
            Mail::to($client->email)->send(new EmailConversationNotification($conversation, 'new_message'));
            $this->info('✅ Admin-to-client email notification sent successfully!');
            
            // Log the email content for verification
            Log::info('Email Conversation Test - Admin to Client', [
                'to' => $client->email,
                'subject' => 'New Message: ' . $conversation->subject,
                'conversation_id' => $conversation->id,
                'type' => 'new_message'
            ]);
            
        } catch (\Exception $e) {
            $this->error('❌ Failed to send admin-to-client notification: ' . $e->getMessage());
            return 1;
        }
        
        // Test 4: Simulate client reply and test client-to-admin notification
        $this->info('💬 Simulating client reply...');
        
        $conversation->update([
            'client_reply' => 'Thank you for your message! This is a test reply to verify the notification system works in both directions.',
            'client_replied_at' => now(),
            'status' => 'replied',
            'admin_read' => false
        ]);
        
        $this->info('📤 Testing client-to-admin email notification...');
        
        try {
            foreach ($admins as $admin) {
                Mail::to($admin->email)->send(new EmailConversationNotification($conversation, 'reply_received'));
            }
            
            $this->info('✅ Client-to-admin email notification sent successfully!');
            
            // Log the email content for verification
            Log::info('Email Conversation Test - Client to Admin', [
                'to' => $admins->pluck('email')->toArray(),
                'subject' => 'Reply Received: ' . $conversation->subject,
                'conversation_id' => $conversation->id,
                'type' => 'reply_received'
            ]);
            
        } catch (\Exception $e) {
            $this->error('❌ Failed to send client-to-admin notification: ' . $e->getMessage());
            return 1;
        }
        
        // Test 5: Verify email template rendering
        $this->info('🎨 Testing email template rendering...');
        
        try {
            $mailable = new EmailConversationNotification($conversation, 'new_message');
            $envelope = $mailable->envelope();
            $content = $mailable->content();
            
            $this->info('✅ Email template renders successfully!');
            $this->info("📧 Subject: {$envelope->subject}");
            $this->info("📄 View: {$content->view}");
            
        } catch (\Exception $e) {
            $this->error('❌ Email template rendering failed: ' . $e->getMessage());
            return 1;
        }
        
        // Test 6: Check current email configuration
        $this->info('⚙️  Current Email Configuration:');
        $this->info('Driver: ' . config('mail.default'));
        $this->info('Host: ' . config('mail.mailers.smtp.host'));
        $this->info('Port: ' . config('mail.mailers.smtp.port'));
        $this->info('From: ' . config('mail.from.address') . ' (' . config('mail.from.name') . ')');
        
        if (config('mail.default') === 'log') {
            $this->warn('⚠️  Email is configured to use LOG driver - emails will be written to storage/logs/laravel.log');
            $this->info('💡 To send real emails, configure SMTP settings in .env file');
        }
        
        // Test 7: Show log file location
        $logFile = storage_path('logs/laravel.log');
        if (file_exists($logFile)) {
            $this->info("📋 Check email content in: {$logFile}");
            
            // Show recent email logs
            $this->info('📧 Recent email logs:');
            $logs = file_get_contents($logFile);
            $emailLogs = collect(explode("\n", $logs))
                ->filter(function ($line) {
                    return strpos($line, 'Email Conversation Test') !== false;
                })
                ->take(-10) // Get last 10 entries
                ->values();
                
            foreach ($emailLogs as $log) {
                $this->line('  ' . $log);
            }
        }
        
        $this->info('🎉 Email conversation notification test completed!');
        $this->info("📧 Test conversation ID: {$conversation->id}");
        $this->info('🔍 Check the logs above to verify email notifications were triggered.');
        
        return 0;
    }
}