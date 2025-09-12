<?php

namespace App\Console\Commands;

use App\Mail\TestEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Exception;

class SendTestEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:test {email?} {--name=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a test email to verify SMTP configuration';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🏗️  Sky Land Construction - Email Test');
        $this->line('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');

        // Display current configuration
        $this->displayConfiguration();

        // Get email address
        $email = $this->argument('email') ?: $this->ask('Enter email address to test');
        
        if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error('❌ Invalid email address provided');
            return 1;
        }

        // Get recipient name
        $name = $this->option('name') ?: $this->ask('Enter recipient name (optional)', 'Test User');

        $this->info("📧 Sending test email to: {$email}");
        $this->info("👤 Recipient name: {$name}");
        
        // Show progress
        $progressBar = $this->output->createProgressBar(3);
        $progressBar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %message%');
        
        $progressBar->setMessage('Preparing email...');
        $progressBar->start();
        
        try {
            $progressBar->advance();
            $progressBar->setMessage('Connecting to SMTP server...');
            sleep(1);
            
            $testData = [
                'recipient_name' => $name,
                'message' => 'This is a test email sent from the command line to verify Sky Land Construction email configuration. If you receive this email, your SMTP settings are working correctly!',
                'timestamp' => now()->format('Y-m-d H:i:s'),
            ];

            $progressBar->advance();
            $progressBar->setMessage('Sending email...');
            sleep(1);

            Mail::to($email)->send(new TestEmail($testData));
            
            $progressBar->advance();
            $progressBar->setMessage('Email sent successfully!');
            $progressBar->finish();
            
            $this->newLine(2);
            $this->info('✅ Test email sent successfully!');
            $this->line("📧 Email: {$email}");
            $this->line("👤 Name: {$name}");
            $this->line("⏰ Sent at: {$testData['timestamp']}");
            $this->newLine();
            $this->comment('💡 Check your inbox (and spam folder) for the test email.');
            
            return 0;

        } catch (Exception $e) {
            $progressBar->finish();
            $this->newLine(2);
            $this->error('❌ Failed to send test email');
            $this->error("🚨 Error: {$e->getMessage()}");
            $this->newLine();
            $this->comment('💡 Tips:');
            $this->comment('   • Check your SMTP credentials');
            $this->comment('   • Verify your internet connection');
            $this->comment('   • Ensure the email server allows connections');
            $this->comment('   • Check if two-factor authentication is enabled');
            
            return 1;
        }
    }

    /**
     * Display current email configuration
     */
    private function displayConfiguration()
    {
        $this->comment('📋 Current SMTP Configuration:');
        $this->table(['Setting', 'Value'], [
            ['SMTP Host', config('mail.mailers.smtp.host')],
            ['SMTP Port', config('mail.mailers.smtp.port')],
            ['Encryption', config('mail.mailers.smtp.encryption')],
            ['Username', config('mail.mailers.smtp.username')],
            ['From Address', config('mail.from.address')],
            ['From Name', config('mail.from.name')],
        ]);
        $this->newLine();
    }
}
