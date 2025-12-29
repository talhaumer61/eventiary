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

class VendorAuthController extends Controller
{
    public function showRegister()
    {
        return view('vendor.signup');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string',
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


        return redirect()->route('vendor.verify.otp')->with('success', 'OTP sent to your email');
    }

    public function showOtp()
    {
        return view('vendor.verify_otp');
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
            'phone'   => session('register_data.phone'),
            'password'   => session('plain_password'), // bcrypt applied automatically
            'status'     => 1,
            'login_type' => 4,
            'photo'      => 'images/default_user.png',
        ]);

        // Send account creation email
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
}
