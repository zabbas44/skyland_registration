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
Route::get('/vendors', [PublicVendorController::class, 'create'])->name('vendor.register');
Route::post('/vendors', [PublicVendorController::class, 'store'])->name('vendor.store');
Route::get('/vendor/thank-you/{id}', [PublicVendorController::class, 'thankYou'])->name('vendor.thank-you');

Route::get('/clients', [PublicClientController::class, 'create'])->name('client.register');
Route::post('/clients', [PublicClientController::class, 'store'])->name('client.store');
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
