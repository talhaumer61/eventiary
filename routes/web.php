<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\clientController;
use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\organizerController;
use App\Http\Controllers\siteController;
use App\Http\Controllers\VendorController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\AuthenticateUser;
use App\Http\Middleware\VerifyAdmin;
use App\Http\Middleware\VerifyClient;
use App\Http\Middleware\VerifyOrganizer;
use App\Http\Middleware\VerifyVendor;
use App\Models\Message;
use App\Models\VendorService;
use Illuminate\Support\Facades\Auth;
// Public Routes
Route::get('/', [siteController::class, 'home']);
Route::get('/events/{href?}', [siteController::class, 'events']);
Route::get('/organizers', [siteController::class, 'organizers']);
Route::get('/vendors/{action?}/{id?}', [siteController::class, 'vendors']);
Route::get('/about-us', [siteController::class, 'about_us']);
Route::get('/contact-us', [siteController::class, 'contact_us']);
Route::get('/faqs', [siteController::class, 'faqs']);

// Routes Accessible Only to Guests (Prevent Logged-in Users from Accessing Login/Signup)
Route::middleware([RedirectIfAuthenticated::class])->group(function () {
    // Admin Login
    Route::get('/admin-login', [AdminController::class, 'adminLogin']);
    Route::post('/admin-login', [AdminController::class, 'login'])->name('adminLogin');
    
    
    // Organizer Registration
    Route::get('/organizer-signup', [siteController::class, 'organizer_signup']);
    Route::post('/organizer-signup', [AuthController::class, 'organizer_signup'])->name('organizerSignup');

    // Vendor Registration
    Route::get('/vendor-signup', [VendorController::class, 'vendor_signup']);
    Route::post('/vendor-signup', [AuthController::class, 'vendor_signup'])->name('vendorSignup');
    
    // Client & Organizer Login
    Route::get('/login', [siteController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'user_login'])->name('userLogin');

    // Client Registration
    Route::get('/signup', [siteController::class, 'signup'])->name('signup');
    Route::post('/signup', [AuthController::class, 'signup'])->name('clientSignup');

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
        Route::get('/vendors-list', [AdminController::class, 'vendorsList'])->name('vendorsList');
        Route::get('/transactions', [AdminController::class, 'transactions'])->name('admin.transactions');

        Route::get('/event-types/{action?}/{href?}', [AdminController::class, 'event_types'])->name('event_types');
        Route::post('/event-types/add', [AdminController::class, 'addEventType'])->name('addEventType');
        Route::post('/event-types/edit/{href}', [AdminController::class, 'editEventType'])->name('editEventType');

        // Vendor Types
        Route::get('/vendor-types/{action?}/{href?}', [AdminController::class, 'vendor_types'])->name('vendor_types');
        Route::post('/vendor-types/add', [AdminController::class, 'addVendorType'])->name('addVendorType');
        Route::post('/vendor-types/edit/{href}', [AdminController::class, 'editVendorType'])->name('editVendorType');


        Route::get('/admin-profile', [AdminController::class, 'profile']);

        Route::post('/admin-delete-record', [DatabaseController::class, 'deleteRecord'])->name('admin.delete.record');

    });
    
// });

// Routes Accessible Only to Logged-in Users (Protected Routes)
Route::middleware([AuthenticateUser::class])->group(function () {

    // Chat Routes
    Route::get('/chat', [MessageController::class, 'index'])->name('chat.index');
    Route::post('/messages', [MessageController::class, 'sendMessage'])->name('messages.send');
    Route::get('/messages', [MessageController::class, 'fetchMessages'])->name('messages.fetch');
    Route::get('/chat/box', [MessageController::class, 'chatBox'])->name('chat.box');
    Route::post('/start-conversation', [MessageController::class, 'startConversation'])->name('conversation.start');
    Route::get('/conversations/list', function () {
        $user = Auth::user();

        $conversations = Message::where('sender_id', $user->id)
            ->orWhere('receiver_id', $user->id)
            ->latest('created_at')
            ->get()
            ->groupBy(function ($msg) use ($user) {
                // Group by a unique key: user pair + event
                return $msg->sender_id == $user->id
                    ? $msg->receiver_id . '-' . ($msg->event_id ?? 'null')
                    : $msg->sender_id . '-' . ($msg->event_id ?? 'null');
            })
            ->map(function ($msgs) use ($user) {
                $last = $msgs->first(); // last message (latest due to orderBy)
                return (object)[
                    'other_user_id'  => $last->sender_id == $user->id ? $last->receiver_id : $last->sender_id,
                    'event_id'       => $last->event_id,
                    'latest_message' => $last->message,
                    'created_at'      => $last->created_at,
                    'other_user'     => $last->sender_id == $user->id ? $last->receiver : $last->sender,
                ];
            })
            ->sortByDesc('timestamp') // ✅ Sort by latest message
            ->values(); // reset keys

        return view('include.messages.conversations', compact('conversations'));
    })->name('conversations.list');

    // Change Password and Update Profile
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

        Route::get('/my-organizers', [clientController::class, 'my_organizers'])->name('my.organizers');
        Route::post('/assign-organizer', [ClientController::class, 'assignOrganizer'])->name('client.assign.organizer');


        Route::get('/choose-vendors', [ClientController::class, 'my_vendors'])->name('client.my_vendors');
        Route::get('/vendor/{id}/services', function($id) {
            return VendorService::where('id_vendor', $id)
                ->where('is_deleted', 0)
                ->get();
        });
        Route::post('/assign-vendor', [ClientController::class, 'assignVendor'])->name('client.assign.vendor');


        Route::get('/guests/{action?}/{href?}', [clientController::class, 'guests']);
        Route::post('/guests/store', [clientController::class, 'storeGuest'])->name('guests.store');
        Route::post('/guests/update/{href}', [clientController::class, 'updateGuest'])->name('guests.update');

        Route::get('/user-messages', [clientController::class, 'user_messages']);
        Route::get('/payments', [clientController::class, 'payments']);
        Route::get('/budget-tracking', [clientController::class, 'budget_tracking']);

        // Delete Record Route
        Route::post('/delete-record', [DatabaseController::class, 'deleteRecord'])->name('delete.record');
    });
    
    // Routes Accessible Only to Organizers (login_type = 3)
    Route::middleware([VerifyOrganizer::class])->group(function () {
        Route::get('/organizer-dashboard', [organizerController::class, 'index'])->name('oranizer-dashboard');
        Route::get('/my-bookings', [organizerController::class, 'my_bookings']);
        Route::get('/booking-requests', [organizerController::class, 'booking_requests']);
        Route::post('/organizer/request-action', [OrganizerController::class, 'requestAction'])->name('organizer.request-action');

        Route::get('/my-vendors', [organizerController::class, 'vendors']);
        Route::get('/organizer/vendor-services/{vendorId}', [OrganizerController::class, 'getVendorServices']);
        Route::post('/vendor-assignment/submit', [OrganizerController::class, 'submitVendorAssignment'])->name('vendor.assignment.submit');

        Route::get('/profile', [clientController::class, 'profile']);

        Route::post('/organizer-delete-record', [DatabaseController::class, 'deleteRecord'])->name('organizer.delete.record');
    });
    
    // Routes Accessible Only to Vendor (login_type = 4)
    Route::middleware([VerifyVendor::class])->group(function () {
        Route::get('/vendor-dashboard', [VendorController::class, 'index'])->name('vendor-dashboard');
        Route::get('/my-services/{action?}/{href?}', [VendorController::class, 'my_services'])->name('vendor.my_services');
        Route::post('/my-services/store', [VendorController::class, 'store_service'])->name('vendor.storeService');
        Route::put('/my-services/update/{id}', [VendorController::class, 'updateService'])->name('vendor.updateService');

        Route::get('/service-requests', [VendorController::class, 'booking_requests']);
        Route::post('/vendor/request-action', [VendorController::class, 'requestAction'])->name('vendor.request-action');

        Route::get('/service-bookings', [VendorController::class, 'my_bookings']);

        Route::post('/vendor-delete-record', [DatabaseController::class, 'deleteRecord'])->name('vendor.delete.record');


    });
    
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
