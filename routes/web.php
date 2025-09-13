<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\PublicVendorController;
use App\Http\Controllers\PublicClientController;
use App\Http\Controllers\EmailTestController;

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
});

Route::get('/client', [PublicClientController::class, 'create'])->name('client.register');
Route::post('/client', [PublicClientController::class, 'store'])->name('client.store');
Route::get('/client/thank-you/{id}', [PublicClientController::class, 'thankYou'])->name('client.thank-you');

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
});
