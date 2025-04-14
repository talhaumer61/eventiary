<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\clientController;
use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\organizerController;
use App\Http\Controllers\siteController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\AuthenticateUser;
use App\Http\Middleware\VerifyAdmin;
use App\Http\Middleware\VerifyClient;
use App\Http\Middleware\VerifyOrganizer;

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
    
    // Client & Organizer Login
    Route::post('/login', [siteController::class, 'user_login'])->name('userLogin');
    
    // Organizer Registration
    Route::get('/organizer-signup', [siteController::class, 'organizer_signup']);
    Route::post('/organizer-signup', [organizerController::class, 'signup'])->name('organizerSignup');
    
    // Client Registration
    Route::get('/signup', [siteController::class, 'signup'])->name('signup');
    Route::post('/signup', [clientController::class, 'signup'])->name('clientSignup');

    Route::post('/check-availability', [siteController::class, 'checkAvailability'])->name('checkAvailability');
});

// Routes Accessible Only to Logged-in Users (Protected Routes)
// Route::middleware([AuthenticateUser::class])->group(function () {

    // Routes Accessible Only to Admin (login_type = 1)
    Route::middleware([VerifyAdmin::class])->group(function () {
        Route::get('/administrator', [AdminController::class, 'index']);
        Route::get('/events-list', [AdminController::class, 'eventsList'])->name('eventsList');
        Route::get('/users', [AdminController::class, 'usersList'])->name('usersList');
        Route::get('/organizers-list', [AdminController::class, 'organizersList'])->name('organizersList');
        Route::get('/transactions', [AdminController::class, 'transactions'])->name('admin.transactions');
        Route::get('/event-types/{action?}/{href?}', [AdminController::class, 'event_types'])->name('event_types');
        Route::post('/event-types/add', [AdminController::class, 'addEventType'])->name('addEventType');
        Route::post('/event-types/edit/{href}', [AdminController::class, 'editEventType'])->name('editEventType');
        Route::get('/admin-profile', [AdminController::class, 'profile']);

        Route::post('/delete-record', [DatabaseController::class, 'deleteRecord'])->name('delete.record');

    });
    
// });

// Routes Accessible Only to Logged-in Users (Protected Routes)
Route::middleware([AuthenticateUser::class])->group(function () {
    Route::post('/check-current-password', [SiteController::class, 'checkCurrentPassword'])->name('check-current-password');

    Route::post('/change-password', [siteController::class, 'changePassword'])->name('change-password');

    Route::post('/update-profile', [siteController::class, 'updateProfile'])->name('update.profile');

    // Routes Accessible Only to Clients (login_type = 2)
    Route::middleware([VerifyClient::class])->group(function () {
        Route::get('/client-dashboard', [clientController::class, 'index'])->name('dashboard');
        Route::get('/user-profile', [clientController::class, 'profile']);

        Route::get('/create-event', [clientController::class, 'create_event']);
        Route::post('/create-event', [clientController::class, 'store_event'])->name('event.store');

        Route::get('/my-events/{event_href?}', [clientController::class, 'my_events']);
        Route::post('/my-events/update/{event_href}', [clientController::class, 'update_event'])->name('event.update');

        Route::get('/guests', [clientController::class, 'guests']);
        Route::get('/user-messages', [clientController::class, 'user_messages']);
        Route::get('/payments', [clientController::class, 'payments']);
        Route::get('/budget-tracking', [clientController::class, 'budget_tracking']);

        // Delete Record Route
        Route::post('/delete-record', [DatabaseController::class, 'deleteRecord'])->name('delete.record');
    });
    
    // Routes Accessible Only to Organizers (login_type = 3)
    Route::middleware([VerifyOrganizer::class])->group(function () {
        Route::get('/organizer-dashboard', [organizerController::class, 'index'])->name('oranizer-dashboard');
        Route::get('/profile', [clientController::class, 'profile']);
    });
    
    Route::get('/logout', [siteController::class, 'logout'])->name('logout');
});
