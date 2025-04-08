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
        return view('client.profile');
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
