<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\clientController;
use App\Http\Controllers\siteController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\AuthenticateUser;
use App\Http\Middleware\VerifyAdmin;
use App\Http\Middleware\VerifyClient;

// Public Routes
Route::get('/', [siteController::class, 'home']);
Route::get('/events', [siteController::class, 'events']);
Route::get('/organizers', [siteController::class, 'organizers']);

// Routes Accessible Only to Guests (Prevent Logged-in Users from Accessing Login/Signup)
Route::middleware([RedirectIfAuthenticated::class])->group(function () {
    Route::get('/login', [siteController::class, 'login'])->name('login');
    // Admin Login
    Route::get('/admin-login', [AdminController::class, 'adminLogin']);
    Route::post('/admin-login', [AdminController::class, 'login'])->name('adminLogin');
    
    Route::post('/login', [clientController::class, 'login'])->name('clientLogin');
    Route::get('/signup', [siteController::class, 'signup'])->name('signup');
    Route::post('/signup', [clientController::class, 'signup'])->name('clientSignup');
    Route::post('/check-availability', [ClientController::class, 'checkAvailability'])->name('checkAvailability');
});

// Routes Accessible Only to Logged-in Users (Protected Routes)
// Route::middleware([AuthenticateUser::class])->group(function () {
    // Routes Accessible Only to Admin (login_type = 1)
    Route::middleware([VerifyAdmin::class])->group(function () {
        Route::get('/administrator', [AdminController::class, 'index']);
        // Route::get('/create-event', [clientController::class, 'create_event']);
    });
    
// });

// Routes Accessible Only to Logged-in Users (Protected Routes)
Route::middleware([AuthenticateUser::class])->group(function () {
    // Routes Accessible Only to Clients (login_type = 2)
    Route::middleware([VerifyClient::class])->group(function () {
        Route::get('/client-dashboard', [clientController::class, 'index'])->name('dashboard');
        Route::get('/create-event', [clientController::class, 'create_event']);
    });
    
    Route::get('/profile', [clientController::class, 'profile']);
    Route::get('/logout', [clientController::class, 'logout'])->name('logout');
});
