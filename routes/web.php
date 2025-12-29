<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\clientController;
use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OrganizerAuthController;
use App\Http\Controllers\organizerController;
use App\Http\Controllers\OrganizerPortfolioController;
use App\Http\Controllers\OrganizerTeamController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\siteController;
use App\Http\Controllers\SiteJobsController;
use App\Http\Controllers\StripeConnectController;
use App\Http\Controllers\VendorAuthController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\VendorPaymentController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\AuthenticateUser;
use App\Http\Middleware\VerifyAdmin;
use App\Http\Middleware\VerifyClient;
use App\Http\Middleware\VerifyOrganizer;
use App\Http\Middleware\VerifyVendor;
use App\Models\JobApplication;
use App\Models\Message;
use App\Models\VendorService;
use Illuminate\Support\Facades\Auth;
// Public Routes
Route::get('/', [siteController::class, 'home']);
Route::get('/events/{href?}', [siteController::class, 'events']);
Route::get('/organizers', [siteController::class, 'organizers']);
Route::get('/organizer/{id}', [siteController::class, 'organizerProfile'])->name('organizer.profile');


Route::get('/vendors/{action?}/{id?}', [siteController::class, 'vendors']);
Route::get('/about-us', [siteController::class, 'about_us']);
Route::get('/contact-us', [siteController::class, 'contact_us']);
Route::get('/faqs', [siteController::class, 'faqs']);
Route::get('/listed-jobs', [SiteJobsController::class, 'index']);
Route::get('/job-detail/{job}', [SiteJobsController::class, 'show'])->name('jobs.show');

Route::post('/jobs/{job}/apply', [JobApplicationController::class, 'apply'])
     ->name('jobs.apply');

        Route::get('/my-jobs/{jobId}/applications', [JobController::class, 'applications']);


// Routes Accessible Only to Guests (Prevent Logged-in Users from Accessing Login/Signup)
Route::middleware([RedirectIfAuthenticated::class])->group(function () {
    // Admin Login
    Route::get('/admin-login', [AdminController::class, 'adminLogin']);
    Route::post('/admin-login', [AdminController::class, 'login'])->name('adminLogin');
    
    
    // Organizer Registration
    // Route::get('/organizer-signup', [siteController::class, 'organizer_signup']);
    // Route::post('/organizer-signup', [AuthController::class, 'organizer_signup'])->name('organizerSignup');

    // Vendor Registration
    // Route::get('/vendor-signup', [VendorController::class, 'vendor_signup']);
    // Route::post('/vendor-signup', [AuthController::class, 'vendor_signup'])->name('vendorSignup');
    
    // Client & Organizer Login
    Route::get('/login', [siteController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'user_login'])->name('userLogin');

    Route::get('/signup', [AuthController::class, 'showRegister']);
    Route::post('/register', [AuthController::class, 'register'])->name('clientSignup');

    Route::get('/verify-otp', [AuthController::class, 'showOtp'])->name('verify.otp');
    Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
    Route::get('/resend-otp', [AuthController::class, 'resendOtp'])->name('resend.otp');
    
    // Organizer Registration
    Route::get('/organizer-signup', [OrganizerAuthController::class, 'showRegister']);
    Route::post('/organizer-register', [OrganizerAuthController::class, 'register'])->name('organizerSignup');

    Route::get('/organizer-verify-otp', [OrganizerAuthController::class, 'showOtp'])->name('organizer.verify.otp');
    Route::post('/organizer-verify-otp', [OrganizerAuthController::class, 'verifyOtp']);
    Route::get('/organizer-resend-otp', [OrganizerAuthController::class, 'resendOtp'])->name('organizer.resend.otp');
    
    Route::get('/vendor-signup', [VendorAuthController::class, 'showRegister']);
    Route::post('/vendor-register', [VendorAuthController::class, 'register'])->name('vendorSignup');

    Route::get('/vendor-verify-otp', [VendorAuthController::class, 'showOtp'])->name('vendor.verify.otp');
    Route::post('/vendor-verify-otp', [VendorAuthController::class, 'verifyOtp']);
    Route::get('/vendor-resend-otp', [VendorAuthController::class, 'resendOtp'])->name('vendor.resend.otp');


    // Client Registration
    // Route::get('/signup', [siteController::class, 'signup'])->name('signup');
    // Route::post('/signup', [AuthController::class, 'signup'])->name('clientSignup');

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
        Route::get('/all-jobs', [AdminController::class, 'all_jobs'])->name('admin.jobs');

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
Route::get('/organizer/connect', [StripeConnectController::class, 'connect'])
    ->name('organizer.connect');

Route::get('/organizer/connect/callback', [StripeConnectController::class, 'callback'])
    ->name('organizer.connect.callback');


        // Vendor Stripe onboarding
        Route::get('/vendor/connect', [StripeConnectController::class, 'vendorConnect'])->name('vendor.connect');
        Route::get('/vendor/callback', [StripeConnectController::class, 'vendorCallback'])->name('vendor.connect.callback');
Route::middleware([AuthenticateUser::class])->group(function () {

    // Organizer Payment
    Route::get('/pay/assignment/{id}', [PaymentController::class, 'payAssignment'])->name('assignment.pay');
    Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');

    // Vendor Payments
    Route::get('/vendor-assignment/{id}/pay', [VendorPaymentController::class, 'payVendorAssignment'])->name('vendor.assignment.pay');
    Route::get('/vendor/payment/success', [VendorPaymentController::class, 'success'])->name('vendor.payment.success');
    Route::get('/vendor/payment/cancel', [VendorPaymentController::class, 'cancel'])->name('vendor.payment.cancel');


    // Stripe webhook
    Route::post('/stripe/webhook', [PaymentController::class, 'webhook'])->name('stripe.webhook');

    Route::post('/client/review/submit', [ClientController::class, 'submitReview'])
    ->name('client.submit.review');
    Route::post('/vendor/review/submit', [ClientController::class, 'submitVendorReview'])
    ->name('client.vendor.submit.review');



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

        Route::get('/my-cards/{eventId?}', [CardController::class, 'my_cards'])->name('my.cards');
        Route::post('/cards/store', [CardController::class, 'store'])->name('cards.store');
        Route::get('/cards/{card}', [CardController::class, 'show'])->name('cards.show');
        Route::post('/cards/share', [CardController::class, 'share'])->name('client.cards.share');


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

        Route::get('/my-jobs/{action?}/{job?}', [JobController::class, 'index']);
        // Route::resource('job-detail/manage', [JobController::class,'manage']);
        Route::post('/my-jobs/store', [JobController::class, 'store'])->name('jobs.store');

        


        // Delete Record Route
        Route::post('/delete-record', [DatabaseController::class, 'deleteRecord'])->name('delete.record');
    });
    
    // Routes Accessible Only to Organizers (login_type = 3)
    Route::middleware([VerifyOrganizer::class])->group(function () {
        // Payment Routes
        

        Route::get('/organizer-dashboard', [organizerController::class, 'index'])->name('oranizer-dashboard');
        Route::get('/my-bookings', [organizerController::class, 'my_bookings']);
        Route::get('/booking-requests', [organizerController::class, 'booking_requests']);
        Route::post('/organizer/request-action', [OrganizerController::class, 'requestAction'])->name('organizer.request-action');

        Route::get('/my-vendors', [organizerController::class, 'vendors']);
        Route::get('/organizer/vendor-services/{vendorId}', [OrganizerController::class, 'getVendorServices']);
        Route::post('/vendor-assignment/submit', [OrganizerController::class, 'submitVendorAssignment'])->name('vendor.assignment.submit');

        Route::get('/profile', [clientController::class, 'profile']);

        Route::get('/my-payments/{type}', [organizerController::class, 'payments'])->name('organizer.payments');
        
        Route::get('/portfolio/{action?}/{id?}', [OrganizerPortfolioController::class, 'index'])->name('organizer.portfolio.index');
        Route::post('/portfolio/store', [OrganizerPortfolioController::class, 'store'])->name('organizer.portfolio.store');
        Route::post('/portfolio/{portfolio}/update', [OrganizerPortfolioController::class, 'update'])->name('organizer.portfolio.update');
        Route::delete('/portfolio/{portfolio}/delete', [OrganizerPortfolioController::class, 'destroy'])->name('organizer.portfolio.delete');

        Route::get('/team/{action?}/{id?}', [OrganizerTeamController::class, 'index'])->name('organizer.team.index');
        Route::post('/team/store', [OrganizerTeamController::class, 'store'])->name('organizer.team.store');
        Route::post('/team/update/{id}', [OrganizerTeamController::class, 'update'])->name('organizer.team.update');
        Route::delete('/team/delete/{id}', [OrganizerTeamController::class, 'destroy'])->name('organizer.team.delete');

         // Delete Record Route

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
        Route::get('/vendor/profile', [clientController::class, 'profile']);

        Route::get('/vendor/payments', [VendorController::class, 'payments'])->name('vendor.payments');

         // Delete Record Route

        Route::post('/vendor-delete-record', [DatabaseController::class, 'deleteRecord'])->name('vendor.delete.record');


    });
    
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
