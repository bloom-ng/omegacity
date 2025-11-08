<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\ReceiptController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AgentTargetController;
use App\Http\Controllers\Admin\LandListingController;
use App\Http\Controllers\Agent\DashboardController as AgentDashboardController;
use Mews\Captcha\Facades\Captcha;

// Authentication Routes
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('loginform');
Route::post('/admin/login', [LoginController::class, 'login'])->name('login');
Route::get('/password/forgot', [AuthController::class, 'showLinkRequestForm'])->name('password.request');


Route::get('/reload-captcha', function () {
    return response()->json(['captcha' => captcha_src('flat')]);
});

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

    Route::get('/profile', [UserController::class, 'profile'])
        ->name('profile.index');

    Route::put('/users/{user}/update-password', [UserController::class, 'updatePassword'])
        ->name('users.update-password');


    //contact messages
    Route::resource('contacts', ContactController::class);

    //Settings
    Route::resource('settings', SettingController::class);

    // Agent Targets Management
    Route::get('/agents', [AgentTargetController::class, 'index'])->name('targets.index');
    Route::get('/agents/{agent}/targets/create', [AgentTargetController::class, 'create'])->name('targets.create');
    Route::post('/agents/{agent}/targets', [AgentTargetController::class, 'store'])->name('targets.store');
    Route::get('/agents/{agent}/targets', [AgentTargetController::class, 'show'])->name('targets.show');
    Route::get('/agents/{agent}/targets/{target}/edit', [AgentTargetController::class, 'edit'])->name('targets.edit');
    Route::put('/agents/{agent}/targets/{target}', [AgentTargetController::class, 'update'])->name('targets.update');
    Route::delete('/agents/{agent}/targets/{target}', [AgentTargetController::class, 'destroy'])->name('targets.destroy');
    Route::post('/agents/refresh-progress', [AgentTargetController::class, 'refreshProgress'])->name('targets.refresh');
});

// Agent Routes
Route::middleware(['auth'])->prefix('agent')->name('agent.')->group(function () {
    // Agent Dashboard
    Route::get('/dashboard', [AgentDashboardController::class, 'index'])->name('dashboard');

    // Agent Clients Management
    Route::get('/clients', [AgentDashboardController::class, 'clients'])->name('clients');
    Route::get('/clients/create', [AgentDashboardController::class, 'createClient'])->name('clients.create');
    Route::post('/clients', [AgentDashboardController::class, 'storeClient'])->name('clients.store');

    // Agent Targets View
    Route::get('/targets', [AgentDashboardController::class, 'targets'])->name('targets');
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
