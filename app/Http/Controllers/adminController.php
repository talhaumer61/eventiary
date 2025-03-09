<?php

namespace App\Http\Controllers;

use App\Models\EventType;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }

    public function event_types($action="list",$href=null){
        if($action == "edit" && isset($href)){

        }else{
            return view('admin.event_types',compact('action'));
        }
    }

    public function addEventType(Request $request)
    {
        // Validate the form input
        $request->validate([
            'type_name'   => 'required|string|max:255',
            'type_status' => 'required|in:1,2',
            'type_desc'   => 'nullable|string|max:500',
            'type_icon'   => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048', // Max 2MB
        ]);

        // Define custom storage path
        $iconPath = null;
        if ($request->hasFile('type_icon')) {
            $file = $request->file('type_icon');

            // Define the destination path
            $destinationPath = public_path('uploads/events/types');

            // Ensure the directory exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            // Generate a unique filename
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Move the file to the destination
            $file->move($destinationPath, $fileName);

            // Store the relative path in the database
            $iconPath = 'uploads/events/types/' . $fileName;
        }

        // Insert into database
        EventType::create([
            'type_name'   => $request->type_name,
            'type_href'   => Str::slug($request->type_name),
            'type_status' => $request->type_status,
            'type_desc'   => $request->type_desc,
            'type_icon'  => $iconPath, // Store the file path
            'id_added'    => session('user')->id,
            'date_added'  => now(),
        ]);

        return redirect('/event-types')->with('success', 'Event type added successfully!');
    }

    public function adminLogin(){
        return view('admin.login');
    }
    public function profile(){
        $user = User::where('id', session('user')->id)->first(); // Fetch user data using model

        return view('admin.profile', compact('user'));
    }
    public function login(Request $request)
    {
        // if (session()->has('user')) {
        //     return redirect('/client-dashboard');
        // }
        
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'login_type' => 'required|string',
        ]);

        // $user = DB::table(env('USERS'))->where('username', $request->username)->first();
        $user = DB::table(env('USERS'))
                ->where(function ($query) use ($request) {
                    $query ->where('username', $request->username)
                            ->where('login_type', $request->login_type)
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
                $photoPath = 'images/default_user.png';
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
                // sessionMsg('success', 'Login Successfully', 'success');
                // return redirect('/client-dashboard ');
                return redirect('/administrator');
            } else {
                return back()->withErrors(['password' => 'The password is incorrect.'])->withInput();
                // return redirect('/portal');
            }
        } else {
            return back()->withErrors(['username' => 'The username does not exist.'])->withInput();
            // return redirect('/portal');
        }
    }
}
