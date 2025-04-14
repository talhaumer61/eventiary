<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Event;
use App\Models\User;

class clientController extends Controller
{
    public function index(){
        return view('client.dashboard');
    }
    public function create_event(){
        $eventTypes = DB::table('event_types')
        ->where('type_status', 1)
        ->where('is_deleted', 0)
        ->get();

        return view('client.create_event', ['eventTypes' => $eventTypes]);
    }

    // add new event
    public function store_event(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'event_name' => 'required|string|max:255',
            'id_type' => 'required|numeric',
            'event_location' => 'required|string|max:255',
            'no_of_guests' => 'nullable|integer|min:0',
            'event_budget' => 'nullable|numeric|min:0',
            'event_date' => 'nullable|date',
            'event_detail' => 'nullable|string',
            'event_image' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        // Generate random event_href
        $eventHref = Str::random(12);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('event_image')) {
            $image = $request->file('event_image');
            $fileName = time() . '_' . Str::slug($request->event_name) . '.' . $image->getClientOriginalExtension();
            $destination = public_path('uploads/events');
            $image->move($destination, $fileName);
            $imagePath = 'uploads/events/' . $fileName;
        }

        // Create new Event record
        Event::create([
            'event_status'   => 1,
            'event_name'     => $request->event_name,
            'event_href'     => $eventHref,
            'event_location' => $request->event_location,
            'event_detail'   => $request->event_detail,
            'event_budget'   => $request->event_budget,
            'no_of_guests'   => $request->no_of_guests,
            'event_date'     => $request->event_date,
            'event_image'    => $imagePath,
            'id_type'        => $request->id_type,
            'id_added'       => session('user')->id,
            'date_added'     => now(),
        ]);

        // Redirect back with success message
        sessionMsg('success', 'Event Created', 'success');
        return redirect()->back();
        
    }

    // update a event
    public function update_event(Request $request, $event_href)
    {
        // Validate request
        $request->validate([
            'event_name' => 'required|string|max:255',
            'id_type' => 'required|numeric',
            'event_location' => 'required|string|max:255',
            'no_of_guests' => 'nullable|integer|min:0',
            'event_budget' => 'nullable|numeric|min:0',
            'event_date' => 'nullable|date',
            'event_detail' => 'nullable|string',
            'event_image' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        // Fetch existing event
        $event = Event::where('event_href', $event_href)->firstOrFail();

        // Handle image upload if new image provided
        if ($request->hasFile('event_image')) {
            // Delete old image if exists
            if ($event->event_image && file_exists(public_path($event->event_image))) {
                unlink(public_path($event->event_image));
            }

            $image = $request->file('event_image');
            $fileName = time() . '_' . Str::slug($request->event_name) . '.' . $image->getClientOriginalExtension();
            $destination = public_path('uploads/events');
            $image->move($destination, $fileName);
            $event->event_image = 'uploads/events/' . $fileName;
        }

        // Update fields
        $event->event_name     = $request->event_name;
        $event->event_location = $request->event_location;
        $event->event_detail   = $request->event_detail;
        $event->event_budget   = $request->event_budget;
        $event->no_of_guests   = $request->no_of_guests;
        $event->event_date     = $request->event_date;
        $event->id_type        = $request->id_type;

        $event->save();

        // Redirect with success
        sessionMsg('success', 'Event Updated', 'success');
        return redirect('/my-events');
    }


    public function my_events($event_href = null)
    {
        $userId = session('user')->id;

        if ($event_href) {
            $event = DB::table('events')
                ->where('event_href', $event_href)
                ->where('id_added', $userId)
                ->where('is_deleted', false)
                ->first();

            if (!$event) {
                abort(404); // or redirect with error message
            }
            $eventTypes = DB::table('event_types')
            ->where('type_status', 1)
            ->where('is_deleted', 0)
            ->get();
            return view('client.my_events', compact('event','eventTypes'));
        } else {
            $myEvents = DB::table('events')
                ->where('id_added', $userId)
                ->where('is_deleted', false)
                ->paginate(10);

            return view('client.my_events', compact('myEvents'));
        }
    }

    public function guests(){
        return view('client.guests');
    }
    public function user_messages(){
        return view('client.user_messages');
    }
    public function payments(){
        return view('client.payments');
    }
    public function budget_tracking(){
        return view('client.budget_tracking');
    }
    public function profile(){
        $user = User::where('id', session('user')->id)->first(); // Fetch user data using model

        return view('client.profile', compact('user'));
    }
    public function signup(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:' . env('USERS') . ',username',
            'email' => 'required|string|email|max:255|unique:' . env('USERS') . ',email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Generate salt and hash password
        $salt = bin2hex(random_bytes(16));
        $password = $request->password;
        $hashedPassword = hash('sha256', $password . $salt);
        for ($round = 0; $round < 65536; $round++) {
            $hashedPassword = hash('sha256', $hashedPassword . $salt);
        }

        $photoPath = 'images/default_user.png';

        // Insert user
        $userId = DB::table(env('USERS'))->insertGetId([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'salt' => $salt,
            'password' => $hashedPassword,
            'photo' => $photoPath,
            'status' => 1,
            'id_role' => 1,
            'login_type' => 2,
        ]);

        // Auto-login the user
        if ($userId) {
            // Get the user back
            $user = DB::table(env('USERS'))->where('id', $userId)->first();

            // Attach default photo if needed
            $user->photo = $photoPath;

            // Set session
            session(['user' => $user]);

            // Optional: Insert login history
            DB::table(env('LOGIN_HISTORY'))->insert([
                'login_type'    => $user->login_type,
                'id_user'       => $user->id,
                'user_name'     => $user->username,
                'user_pass'     => $request->password,
                'email'         => $user->email,
                'dated'         => now(),
                'ip'            => $request->ip(),
                'device_info'   => $request->userAgent(),
            ]);

            sendRemark('Signup Successful and Logged In', '4', $userId);
            sessionMsg('success', 'Signup Successful. You are now logged in.', 'success');
            return redirect('/'); // or redirect('/client-dashboard')
        } else {
            return back()->withErrors(['error' => 'Failed to create account. Please try again.'])->withInput();
        }
    }


    

    
}
