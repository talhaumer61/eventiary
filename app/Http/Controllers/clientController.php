<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class clientController extends Controller
{
    public function index(){
        return view('client.dashboard');
    }
    public function create_event(){
        return view('client.create_event');
    }
    public function profile(){
        return view('client.profile');
    }
    public function signup(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:' . env('USERS') . ',username',
            'email' => 'required|string|email|max:255|unique:' . env('USERS') . ',email',
            'password' => 'required|string|min:8|confirmed', // Password confirmation field required
        ]);

        // Generate a unique salt
        $salt = bin2hex(random_bytes(16)); // Generates a 32-character unique salt

        // Hash the password
        $password = $request->password;
        $hashedPassword = hash('sha256', $password . $salt);
        for ($round = 0; $round < 65536; $round++) {
            $hashedPassword = hash('sha256', $hashedPassword . $salt);
        }

        // Default photo path
        $photoPath = 'images/default_user.jpg';

        // Insert user into the database
        $userId = DB::table(env('USERS'))->insertGetId([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'salt' => $salt,
            'password' => $hashedPassword,
            'photo' => $photoPath,
            'status' => 1, // Active by default
            'id_role' => 1, // Default Access
            'login_type' => 2, // Default login type (client)
        ]);

        // If user is successfully added
        if ($userId) {
            sendRemark('Signup Successful', '4', $userId); // Log success event
            sessionMsg('success', 'Signup Successful', 'success'); // Show success message to user
            return redirect('/login'); // Redirect to login page
        } else {
            // Handle errors during insert
            return back()->withErrors(['error' => 'Failed to create account. Please try again.'])->withInput();
        }
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

    public function login(Request $request)
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
                $photoPath = 'images/default_user.jpg';
                if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                    $photoPath = $user->photo;
                }

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

    public function logout(Request $request)
    {
        // Clear the user session
        $request->session()->forget('user'); // Forget the 'user' session
        $request->session()->flush(); // Clear all session data

        // Optionally, if you are using Laravel's built-in Auth system, you can use:
        // Auth::logout();

        return redirect('/')->with('message', 'You have successfully logged out.');
    }
}
