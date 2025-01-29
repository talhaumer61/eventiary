<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\clientController;
use App\Http\Controllers\siteController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\AuthenticateUser;
use App\Http\Middleware\VerifyClient;

// Public Routes
Route::get('/', [siteController::class, 'home']);
Route::get('/events', [siteController::class, 'events']);
Route::get('/organizers', [siteController::class, 'organizers']);

// Routes Accessible Only to Guests (Prevent Logged-in Users from Accessing Login/Signup)
Route::middleware([RedirectIfAuthenticated::class])->group(function () {
    Route::get('/login', [siteController::class, 'login'])->name('login');
    Route::post('/login', [clientController::class, 'login'])->name('clientLogin');
    Route::get('/signup', [siteController::class, 'signup'])->name('signup');
    Route::post('/signup', [clientController::class, 'signup'])->name('clientSignup');
});

// Routes Accessible Only to Logged-in Users (Protected Routes)
Route::middleware([AuthenticateUser::class])->group(function () {
    // Routes Accessible Only to Clients (login_type = 2)
    Route::middleware([VerifyClient::class])->group(function () {
        Route::get('/client-dashboard', [clientController::class, 'index'])->name('dashboard');
        Route::get('/create-event', [clientController::class, 'create_event']);
        Route::get('/profile', [clientController::class, 'profile']);
    });

    Route::get('/logout', [clientController::class, 'logout'])->name('logout');
});
