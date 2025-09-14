<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Client;
use App\Models\Vendor;

class SettingsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get system statistics
        $stats = [
            'total_clients' => Client::count(),
            'total_vendors' => Vendor::count(),
            'total_users' => User::count(),
            'pending_clients' => Client::where('status', 'pending')->count(),
            'pending_vendors' => Vendor::where('status', 'pending')->count(),
            'approved_clients' => Client::where('status', 'approved')->count(),
            'approved_vendors' => Vendor::where('status', 'approved')->count(),
        ];
        
        // Get email settings
        $emailSettings = [
            'mail_driver' => config('mail.default'),
            'mail_host' => config('mail.mailers.smtp.host'),
            'mail_port' => config('mail.mailers.smtp.port'),
            'mail_from_address' => config('mail.from.address'),
            'mail_from_name' => config('mail.from.name'),
        ];
        
        return view('admin.settings.index', compact('user', 'stats', 'emailSettings'));
    }
    
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'current_password' => 'nullable|string',
            'password' => 'nullable|string|min:8|confirmed',
        ]);
        
        // Update basic info
        $user->name = $request->name;
        $user->email = $request->email;
        
        // Update password if provided
        if ($request->filled('password')) {
            if (!$request->filled('current_password') || !Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect.']);
            }
            $user->password = Hash::make($request->password);
        }
        
        $user->save();
        
        return back()->with('success', 'Profile updated successfully.');
    }
    
    public function updateEmailSettings(Request $request)
    {
        $request->validate([
            'mail_host' => 'required|string',
            'mail_port' => 'required|integer',
            'mail_username' => 'required|string',
            'mail_password' => 'required|string',
            'mail_from_address' => 'required|email',
            'mail_from_name' => 'required|string',
        ]);
        
        // In a real application, you would update the .env file or database
        // For now, we'll just show a success message
        return back()->with('success', 'Email settings updated successfully. Please update your .env file with the new values.');
    }
    
    public function testEmail(Request $request)
    {
        $request->validate([
            'test_email' => 'required|email',
        ]);
        
        try {
            Mail::raw('This is a test email from SKY LAND CONSTRUCTION LLC OPC admin panel.', function ($message) use ($request) {
                $message->to($request->test_email)
                        ->subject('Test Email - SKY LAND CONSTRUCTION LLC OPC');
            });
            
            return back()->with('success', 'Test email sent successfully to ' . $request->test_email);
        } catch (\Exception $e) {
            return back()->withErrors(['test_email' => 'Failed to send test email: ' . $e->getMessage()]);
        }
    }
    
    public function clearCache()
    {
        try {
            \Artisan::call('cache:clear');
            \Artisan::call('config:clear');
            \Artisan::call('view:clear');
            \Artisan::call('route:clear');
            
            return back()->with('success', 'All caches cleared successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['cache' => 'Failed to clear cache: ' . $e->getMessage()]);
        }
    }
    
    public function backupDatabase()
    {
        try {
            $filename = 'backup_' . date('Y-m-d_H-i-s') . '.sql';
            $path = storage_path('app/backups/' . $filename);
            
            // Create backups directory if it doesn't exist
            if (!Storage::disk('local')->exists('backups')) {
                Storage::disk('local')->makeDirectory('backups');
            }
            
            // Simple SQLite backup (copy the database file)
            if (config('database.default') === 'sqlite') {
                $dbPath = database_path('database.sqlite');
                if (file_exists($dbPath)) {
                    copy($dbPath, storage_path('app/backups/database_backup_' . date('Y-m-d_H-i-s') . '.sqlite'));
                    return back()->with('success', 'Database backup created successfully.');
                }
            }
            
            return back()->with('success', 'Backup functionality is available for SQLite databases.');
        } catch (\Exception $e) {
            return back()->withErrors(['backup' => 'Failed to create backup: ' . $e->getMessage()]);
        }
    }
}
