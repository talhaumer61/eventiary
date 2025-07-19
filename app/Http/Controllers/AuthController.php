<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    // Client Signup
    public function signup(Request $request)
    {
        // Validate request
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create user using Eloquent
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'photo' => 'images/default_user.png',
            'id_role' => 1,
            'login_type' => 2,
        ]);

        // Login user
        Auth::login($user);

        // Optional: Log login history
        DB::table('et_login_history')->insert([
            'login_type'  => $user->login_type,
            'id_user'     => $user->id,
            'user_name'   => $user->username,
            'user_pass'   => '[HIDDEN]', // never log real passwords
            'email'       => $user->email,
            'dated'       => now(),
            'ip'          => $request->ip(),
            'device_info' => $request->userAgent(),
        ]);

        sendRemark('Signup Successful and Logged In', '4', $user->id);
        sessionMsg('success', 'Signup Successful. You are now logged in.', 'success');

        return redirect('/'); // or redirect('/client-dashboard');
    }

    // Organizer Signup
    public function organizer_signup(Request $request)
    {
        // Validate request
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'required|string|max:15|unique:users,phone',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create new organizer user
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'photo' => 'images/default_user.png',
            'id_role' => 1,
            'login_type' => 3, // Organizer login type
        ]);

        // Log the user in
        Auth::login($user);

        // Optional: Insert login history
        DB::table('et_login_history')->insert([
            'login_type'    => $user->login_type,
            'id_user'       => $user->id,
            'user_name'     => $user->username,
            'user_pass'     => '[HIDDEN]',
            'email'         => $user->email,
            'dated'         => now(),
            'ip'            => $request->ip(),
            'device_info'   => $request->userAgent(),
        ]);

        sendRemark('Signup Successful and Logged In', '4', $user->id);
        sessionMsg('success', 'Signup Successful. You are now logged in.', 'success');

        return redirect('/'); // or redirect('/organizer-dashboard');
    }

    // Vendor Signup
    public function vendor_signup(Request $request)
    {
        // Validate request
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'required|string|max:15|unique:users,phone',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create new vendor user
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'photo' => 'images/default_user.png',
            'id_role' => 1, // keep as is, or adjust if needed
            'login_type' => 4, // Vendor login type
        ]);

        // Log the user in
        Auth::login($user);

        // Optional: Insert login history
        DB::table('et_login_history')->insert([
            'login_type'    => $user->login_type,
            'id_user'       => $user->id,
            'user_name'     => $user->username,
            'user_pass'     => '[HIDDEN]',
            'email'         => $user->email,
            'dated'         => now(),
            'ip'            => $request->ip(),
            'device_info'   => $request->userAgent(),
        ]);

        sendRemark('Vendor Signup Successful and Logged In', '4', $user->id);
        sessionMsg('success', 'Signup Successful. You are now logged in.', 'success');

        return redirect('/'); // or redirect('/vendor-dashboard');
    }

    // Client & Organizer Login
    public function user_login(Request $request)
    {
        // Validate request
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Attempt login using either username or email
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$fieldType => $request->username, 'password' => $request->password])) {
            $user = Auth::user();

            // Optional: log login history
            DB::table('et_login_history')->insert([
                'login_type'  => $user->login_type,
                'id_user'     => $user->id,
                'user_name'   => $user->username,
                'user_pass'   => '[HIDDEN]',
                'email'       => $user->email,
                'dated'       => now(),
                'ip'          => $request->ip(),
                'device_info' => $request->userAgent(),
            ]);

            sendRemark('Login Successfully', '4', $user->id);
            sessionMsg('success', 'Login Successfully', 'success');

            return redirect('/');
        } else {
            return back()->withErrors([
                'password' => 'Invalid username/email or password.',
            ])->withInput();
        }
    }

    // Logout user 
    public function logout(Request $request)
    {
        // Clear the user session
        // $request->session()->forget('user'); // Forget the 'user' session
        // $request->session()->flush(); // Clear all session data

        // Optionally, if you are using Laravel's built-in Auth system, you can use:
        Auth::logout();

        return redirect('/')->with('message', 'You have successfully logged out.');
    }
}
