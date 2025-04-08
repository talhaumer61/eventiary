<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class organizerController extends Controller
{
    public function index(){
        return view('organizer.dashboard');
    }
    public function profile(){
        return view('organizer.profile');
    }
    public function signup(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:' . env('USERS') . ',username',
            'email' => 'required|string|email|max:255|unique:' . env('USERS') . ',email',
            'phone' => 'required|string|max:15|unique:' . env('USERS') . ',phone',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Generate a unique salt
        $salt = bin2hex(random_bytes(16));

        // Hash the password
        $password = $request->password;
        $hashedPassword = hash('sha256', $password . $salt);
        for ($round = 0; $round < 65536; $round++) {
            $hashedPassword = hash('sha256', $hashedPassword . $salt);
        }

        // Default photo path
        $photoPath = 'images/default_user.png';

        // Insert user into the database
        $userId = DB::table(env('USERS'))->insertGetId([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'salt' => $salt,
            'password' => $hashedPassword,
            'photo' => $photoPath,
            'status' => 1,
            'id_role' => 1,
            'login_type' => 3,
        ]);

        // If user is successfully added
        if ($userId) {
            // Retrieve the newly created user
            $user = DB::table(env('USERS'))->where('id', $userId)->first();

            // Attach photo
            $user->photo = $photoPath;

            // Set session
            session(['user' => $user]);

            // Insert login history
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

            return redirect('/'); // Or any other post-login page, like '/organizer-dashboard'
        } else {
            return back()->withErrors(['error' => 'Failed to create account. Please try again.'])->withInput();
        }
    }
}
