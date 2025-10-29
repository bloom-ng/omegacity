<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\ReceiptController;
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


         // Receipts
     Route::resource('receipts', ReceiptController::class);
    Route::post('receipts/{receipt}/mark-as-paid', [ReceiptController::class, 'markAsPaid'])
         ->name('receipts.markAsPaid');

    Route::get('receipts/{receipt}/pdf', [ReceiptController::class, 'generatePDF'])
         ->name('receipts.pdf');



    // Clients
    Route::resource('clients', ClientController::class);

    // Land Listings
    Route::resource('landlistings', LandListingController::class);

    // Admin users
    Route::resource('users', UserController::class);

    //contact messages
    Route::resource('contacts', ContactController::class);
});

// Public routes
Route::get('/', [App\Http\Controllers\User\UserController::class, 'HomePage'])
    ->name('home');
Route::get('/contact-us', [App\Http\Controllers\User\UserController::class, 'ContactUsPage'])
    ->name('contact-us');
Route::post('/contact-us', [App\Http\Controllers\User\UserController::class, 'ContactUsStore'])
    ->name('store.contact-us');
Route::get('/land', [App\Http\Controllers\User\UserController::class, 'LandPage'])
    ->name('land');
Route::get('/landlisting/{id}', [App\Http\Controllers\User\UserController::class, 'LandListingPage'])
    ->name('landlisting.show');
Route::get('/about', [App\Http\Controllers\User\UserController::class, 'AboutPage'])
    ->name('about');
