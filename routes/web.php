<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\PublicVendorController;
use App\Http\Controllers\PublicClientController;
use App\Http\Controllers\EmailTestController;
use App\Http\Controllers\EmailConversationController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\ReportsController;

// Redirect root to login
Route::get('/', function () {
    return redirect('/login');
});

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Public registration routes
Route::get('/supplier', [PublicVendorController::class, 'create'])->name('supplier.register');
Route::post('/supplier', [PublicVendorController::class, 'store'])->name('supplier.store');
Route::get('/supplier/thank-you/{id}', [PublicVendorController::class, 'thankYou'])->name('supplier.thank-you');

// CSRF token endpoint for AJAX requests
Route::get('/csrf-token', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});

// Dashboard route - requires authentication
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

// Admin approval routes - requires admin middleware
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Client approval routes
    Route::post('/clients/{client}/approve', [App\Http\Controllers\Admin\ApprovalController::class, 'approveClient'])->name('clients.approve');
    Route::post('/clients/{client}/reject', [App\Http\Controllers\Admin\ApprovalController::class, 'rejectClient'])->name('clients.reject');
    
    // Vendor approval routes
    Route::post('/vendors/{vendor}/approve', [App\Http\Controllers\Admin\ApprovalController::class, 'approveVendor'])->name('vendors.approve');
    Route::post('/vendors/{vendor}/reject', [App\Http\Controllers\Admin\ApprovalController::class, 'rejectVendor'])->name('vendors.reject');
    
    // Email routes
    Route::post('/upload-attachment', [App\Http\Controllers\Admin\EmailController::class, 'uploadAttachment'])->name('email.upload-attachment');
    Route::post('/clients/{client}/send-email', [App\Http\Controllers\Admin\EmailController::class, 'sendToClient'])->name('clients.send-email');
    Route::post('/vendors/{vendor}/send-email', [App\Http\Controllers\Admin\EmailController::class, 'sendToVendor'])->name('vendors.send-email');
});

// Email Conversations routes (protected by auth middleware)
Route::middleware('auth')->prefix('email-conversations')->name('email-conversations.')->group(function () {
    Route::get('/', [EmailConversationController::class, 'index'])->name('index');
    Route::post('/send', [EmailConversationController::class, 'sendFromAdmin'])->name('send');
    Route::post('/{conversation}/reply', [EmailConversationController::class, 'reply'])->name('reply');
    Route::post('/{conversation}/mark-read', [EmailConversationController::class, 'markAsRead'])->name('mark-read');
    Route::get('/entities', [EmailConversationController::class, 'getEntities'])->name('entities');
    Route::get('/{conversation}/download/{type}/{index}', [EmailConversationController::class, 'downloadAttachment'])->name('download');
});

Route::get('/client', [PublicClientController::class, 'create'])->name('client.register');
Route::post('/client', [PublicClientController::class, 'store'])->name('client.store');
Route::get('/client/thank-you/{id}', [PublicClientController::class, 'thankYou'])->name('client.thank-you');

// Conversation routes for clients and vendors (protected by auth)
Route::middleware('auth')->group(function () {
    Route::get('/conversations', [App\Http\Controllers\ChatController::class, 'index'])->name('conversations.index');
    Route::post('/conversations/send', [App\Http\Controllers\ChatController::class, 'sendMessage'])->name('conversations.send');
    Route::get('/conversations/{conversation}/messages', [App\Http\Controllers\ChatController::class, 'getMessages'])->name('conversations.messages');
    Route::post('/conversations/{conversation}/read', [App\Http\Controllers\ChatController::class, 'markAsRead'])->name('conversations.read');
    Route::post('/conversations/upload', [App\Http\Controllers\ChatController::class, 'uploadAttachment'])->name('conversations.upload');
});

// Admin routes (protected by admin middleware)
Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('vendors', VendorController::class);
    Route::post('vendors/{vendor}/contact', [VendorController::class, 'contact'])->name('vendors.contact');
    Route::resource('clients', ClientController::class);
    Route::post('clients/{client}/contact', [ClientController::class, 'contact'])->name('clients.contact');
    
    // Email Testing Routes
    Route::get('/email/test', [EmailTestController::class, 'showTestForm'])->name('email.test');
    Route::post('/email/send-test', [EmailTestController::class, 'sendTestEmail'])->name('email.send-test');
    Route::post('/email/test-connection', [EmailTestController::class, 'testConnection'])->name('email.test-connection');
    
    // Settings Routes
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('/settings/profile', [SettingsController::class, 'updateProfile'])->name('settings.profile');
    Route::post('/settings/email', [SettingsController::class, 'updateEmailSettings'])->name('settings.email');
    Route::post('/settings/test-email', [SettingsController::class, 'testEmail'])->name('settings.test-email');
    Route::post('/settings/clear-cache', [SettingsController::class, 'clearCache'])->name('settings.clear-cache');
    Route::post('/settings/backup', [SettingsController::class, 'backupDatabase'])->name('settings.backup');
    
    // Reports Routes
    Route::get('/reports', [ReportsController::class, 'index'])->name('reports.index');
    Route::get('/reports/export-clients', [ReportsController::class, 'exportClients'])->name('reports.export-clients');
    Route::get('/reports/export-vendors', [ReportsController::class, 'exportVendors'])->name('reports.export-vendors');
    
    // Interactive Map Route
    Route::get('/interactive-map', function () {
        return view('admin.interactive-map');
    })->name('interactive-map');
});
