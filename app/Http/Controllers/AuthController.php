<?php

namespace App\Http\Controllers;

use App\Mail\AccountCreatedMail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Models\EmailOtp;

class AuthController extends Controller
{

    public function showRegister()
    {
        return view('signup');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:8|confirmed',
        ]);

        $otp = rand(100000, 999999);

        EmailOtp::updateOrCreate(
            ['email' => $request->email],
            [
                'otp' => $otp,
                'expires_at' => Carbon::now()->addMinutes(5),
            ]
        );

        Mail::to($request->email)->send(new \App\Mail\OtpMail($otp));

        session([
            'register_data' => $request->except('password', 'password_confirmation'),
            'plain_password' => $request->password
        ]);


        return redirect()->route('verify.otp')->with('success', 'OTP sent to your email');
    }

    public function showOtp()
    {
        return view('verify_otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        if (!session()->has('register_data') || !session()->has('plain_password')) {
            return redirect()->route('register')->with('error', 'Session expired. Please register again.');
        }

        $email = session('register_data.email');

        $record = EmailOtp::where('email', $email)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', now())
            ->first();

        if (!$record) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP']);
        }

        // Create user with bcrypt password
        $user = User::create([
            'name'       => session('register_data.name'),
            'email'      => $email,
            'username'   => session('register_data.username'),
            'password'   => session('plain_password'), // bcrypt applied automatically
            'status'     => 1,
            'login_type' => 2,
            'photo'      => 'images/default_user.png',
        ]);

        Mail::to($user->email)->send(new AccountCreatedMail($user));

        EmailOtp::where('email', $email)->delete();
        session()->forget(['register_data', 'plain_password']);

        // Auto-login
        session(['user' => $user]);
        session()->regenerate();

        sessionMsg('success', 'Account verified successfully and logged in', 'success');

        return redirect('/');
    }
    
    public function resendOtp()
    {
        if (!session()->has('register_data.email')) {
            return redirect()->route('register')->with('error', 'Session expired. Please register again.');
        }

        $email = session('register_data.email');

        // Optional: prevent rapid resend (1 minute cooldown)
        $existingOtp = EmailOtp::where('email', $email)->first();

        if ($existingOtp && $existingOtp->updated_at->gt(now()->subMinute())) {
            return back()->with('error', 'Please wait before requesting another OTP.');
        }

        $otp = rand(100000, 999999);

        EmailOtp::updateOrCreate(
            ['email' => $email],
            [
                'otp' => $otp,
                'expires_at' => now()->addMinutes(5),
            ]
        );

        Mail::to($email)->send(new \App\Mail\OtpMail($otp));

        return back()->with('success', 'A new OTP has been sent to your email.');
    }

    
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
