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
        $photoPath = 'images/default_user.png';

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

    

    
}
