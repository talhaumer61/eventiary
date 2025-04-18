<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class siteController extends Controller
{
    public function home(){
        return view('home');
    }
    public function about_us(){
        return view('about');
    }
    public function contact_us(){
        return view('contact');
    }
    public function faqs(){
        return view('faqs');
    }
    public function login(){
        return view('login');
    }
    public function signup(){
        return view('signup');
    }
    public function organizer_signup(){
        return view('organizer.signup');
    }
    public function organizers(){
        $organizers = User::where('login_type', 3)
                      ->where('is_deleted', false)
                      ->get();

        return view('organizers', compact('organizers'));
    }

    // Events
    public function events($href = null)
    {
        if ($href) {
            $event = DB::table('events')
                ->where('events.event_href', $href)
                ->where('events.is_deleted', false)
                ->where('events.event_status', 1)
                ->first();

            if (!$event) {
                abort(404);
            }

            // Get event type detail
            $eventType = DB::table('event_types')
                ->where('type_id', $event->id_type)
                ->where('is_deleted', false)
                ->where('type_status', 1)
                ->first();

            // Get user who added the event
            $addedBy = DB::table('users')
                ->where('id', $event->id_added)
                ->where('is_deleted', false)
                ->where('status', 1)
                ->first();

            return view('events', [
                'page_title' => $event->event_name . ' | Eventiary',
                'event' => $event,
                'eventType' => $eventType,
                'addedBy' => $addedBy,
                'is_detail' => true
            ]);
        } else {
            $events = DB::table('events')
                ->where('is_deleted', false)
                ->where('event_status', 1)
                ->orderBy('event_date', 'desc')
                ->get();

            return view('events', [
                'page_title' => 'Events | Eventiary',
                'events' => $events,
                'is_detail' => false
            ]);
        }
    }


    // User Authentication
    public function user_login(Request $request)
    {
        // if (session()->has('user')) {
        //     return redirect('/client-dashboard');
        // }
        
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // $user = DB::table(env('USERS'))->where('username', $request->username)->first();
        $user = DB::table(env('USERS'))
                ->where(function ($query) use ($request) {
                    $query->where('username', $request->username)
                        ->whereIn('login_type', [2,3])
                        ->orWhere('email', $request->username);
                })
                ->first();

        if ($user) {
            $salt = $user->salt;
            $storedHash = $user->password;

            $inputHash = hash('sha256', $request->password . $salt);
            for ($round = 0; $round < 65536; $round++) {
                $inputHash = hash('sha256', $inputHash . $salt);
            }

            if ($inputHash === $storedHash) {
                $photoPath = $user->photo ?: 'images/default_user.png';
                $user->photo = $photoPath;

                $user->photo = $photoPath;
                session(['user' => $user]);

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

                sendRemark('Login Successfully', '4', $user->id);
                sessionMsg('success', 'Login Successfully', 'success');
                // return redirect('/client-dashboard ');
                return redirect('/ ');
            } else {
                return back()->withErrors(['password' => 'The password is incorrect.'])->withInput();
                // return redirect('/portal');
            }
        } else {
            return back()->withErrors(['username' => 'The username does not exist.'])->withInput();
            // return redirect('/portal');
        }
    }
    
    // Logout user 
    public function logout(Request $request)
    {
        // Clear the user session
        $request->session()->forget('user'); // Forget the 'user' session
        $request->session()->flush(); // Clear all session data

        // Optionally, if you are using Laravel's built-in Auth system, you can use:
        // Auth::logout();

        return redirect('/')->with('message', 'You have successfully logged out.');
    }

    // Check availability of username or email (AJAX Request)
    public function checkAvailability(Request $request)
    {
        $field = $request->field;
        $value = $request->value;

        $exists = DB::table(env('USERS'))->where($field, $value)->exists();

        return response()->json([
            'exists' => $exists
        ]);
    }

    // Change Password
    public function changePassword(Request $request)
    {
        // Validate input fields
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed', // Must match `new_password_confirmation`
        ]);

        // Fetch the authenticated user from session
        $user = session('user');

        if (!$user) {
            return back()->withErrors(['error' => 'User not found. Please login again.']);
        }

        // Fetch user from database
        $dbUser = DB::table(env('USERS'))->where('id', $user->id)->first();

        if (!$dbUser) {
            return back()->withErrors(['error' => 'User not found in database.']);
        }

        // Verify current password
        $salt = $dbUser->salt;
        $currentHash = hash('sha256', $request->current_password . $salt);
        for ($round = 0; $round < 65536; $round++) {
            $currentHash = hash('sha256', $currentHash . $salt);
        }

        if ($currentHash !== $dbUser->password) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.'])->withInput();
        }

        // Hash new password
        $newHash = hash('sha256', $request->new_password . $salt);
        for ($round = 0; $round < 65536; $round++) {
            $newHash = hash('sha256', $newHash . $salt);
        }

        // Update password in database
        DB::table(env('USERS'))->where('id', $dbUser->id)->update([
            'password' => $newHash,
            'date_modify' => now(),
            'id_modify' => $dbUser->id,
        ]);

        // Log password change event
        sendRemark('Password Changed Successfully', '4', $dbUser->id);
        
        // Store success message
        sessionMsg('success', 'Password changed successfully!', 'success');

        return back();
    }


    public function checkCurrentPassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
        ]);

        // Get the logged-in user
        $user = session('user');

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found. Please login again.']);
        }

        // Fetch user from the database
        $dbUser = DB::table(env('USERS'))->where('id', $user->id)->first();

        if (!$dbUser) {
            return response()->json(['success' => false, 'message' => 'User not found in database.']);
        }

        // Verify current password
        $salt = $dbUser->salt;
        $currentHash = hash('sha256', $request->current_password . $salt);
        for ($round = 0; $round < 65536; $round++) {
            $currentHash = hash('sha256', $currentHash . $salt);
        }

        if ($currentHash !== $dbUser->password) {
            return response()->json(['success' => false, 'message' => 'Current password is incorrect.']);
        }

        return response()->json(['success' => true, 'message' => 'Password is correct.']);
    }

    // Update user Profile
    public function updateProfile(Request $request)
    {
        // Get user from session
        $user = session('user');

        if (!$user) {
            return redirect()->back()->with('error', 'User session not found.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Find the user from database
        $dbUser = \App\Models\User::find($user->id);

        if (!$dbUser) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Handle image upload
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = 'uploads/users';

            // Move uploaded file
            $file->move(public_path($path), $filename);

            // Delete old image if exists
            // if ($dbUser->photo && file_exists(public_path($dbUser->photo))) {
            //     unlink(public_path($dbUser->photo));
            // }

            $dbUser->photo = $path . '/' . $filename;
        }

        // Update other fields
        $dbUser->name = $request->name;
        $dbUser->username = $request->username;
        $dbUser->phone = $request->phone;
        $dbUser->id_modify = $user->id;
        $dbUser->date_modify = now();

        $dbUser->save();

        // Update session data
        session(['user' => $dbUser]);

        sessionMsg('success', 'Profile Updated!', 'success');
        return back()->with('success', 'Profile updated successfully!');
    }



}
