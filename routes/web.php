<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LandListingController;

// Authentication Routes
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('loginform');
Route::post('/admin/login', [LoginController::class, 'login'])->name('login');
Route::get('/password/forgot', [AuthController::class, 'showLinkRequestForm'])->name('password.request');

// Admin Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Invoices
    Route::resource('invoices', InvoiceController::class);
    Route::post('invoices/{invoice}/mark-as-paid', [InvoiceController::class, 'markAsPaid'])
         ->name('invoices.markAsPaid');
   
    Route::get('invoices/{invoice}/pdf', [InvoiceController::class, 'generatePDF'])
         ->name('invoices.pdf');

    // Clients
    Route::resource('clients', ClientController::class);

    // Land Listings
    Route::resource('landlistings', LandListingController::class);

    // Admin users
    Route::resource('users', UserController::class);
});

// Public routes
Route::get('/', [App\Http\Controllers\User\UserController::class, 'HomePage'])
    ->name('home');
Route::get('/contact-us', [App\Http\Controllers\User\UserController::class, 'ContactUsPage'])
    ->name('contact-us');
Route::post('/contact-us', [App\Http\Controllers\User\UserController::class, 'ContactUsStore'])
    ->name('store.contact-us');

