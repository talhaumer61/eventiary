<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventType;
use App\Models\User;
use App\Models\VendorType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }
    public function eventsList()
    {
        $events = Event::with(['user', 'eventType'])
            ->where('is_deleted', false)
            ->orderBy('event_id', 'desc')
            ->get();

        return view('admin.events_list', compact('events'));
    }
    public function usersList(){
        $clients = User::where('login_type', 2)->get(); // Fetch all clients
        return view('admin.users_list', compact('clients'));
    }
    public function organizersList() {
        $organizers = User::where('login_type', 3)->get(); // 3 = Organizer
        return view('admin.organizers_list', compact('organizers'));
    }
    public function vendorsList() {
        $vendors = User::where('login_type', 4)->get(); // 4 = Vendor
        return view('admin.vendors_list', compact('vendors'));
    }
    public function transactions(){
        return view('admin.transactions');
    }

    public function event_types($action="list",$href=null){
        if($action == "edit" && isset($href)){
            $eventType = DB::table('event_types')->where('type_href', $href)->first();
            return view('admin.event_types', compact('action', 'eventType'));
        }else{
            $eventTypes = DB::table('event_types')->select('type_id', 'type_name', 'type_status', 'type_icon', 'type_href')->where('type_status', '1')->where('is_deleted', '0')->paginate(10);;
            // Pass the data to the view
            return view('admin.event_types', compact('action', 'eventTypes'));
        }
    }
    // Add a new Event Type
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
            'id_added'    => Auth::id(), 
            'date_added'  => now(),
        ]);

        return redirect('/event-types')->with('success', 'Event type added successfully!');
    }
    // Edit an Event Tpye
    public function editEventType(Request $request, $href)
    {
        // Find the event type using type_href instead of ID
        $eventType = EventType::where('type_href', $href)->firstOrFail();

        // Validate input (make 'type_icon' nullable)
        $request->validate([
            'type_name'   => 'required|string|max:255',
            'type_status' => 'required|in:1,2',
            'type_desc'   => 'nullable|string|max:500',
            'type_icon'   => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        // Handle file upload only if a new file is provided
        if ($request->hasFile('type_icon')) {
            $file = $request->file('type_icon');
            $destinationPath = public_path('uploads/events/types');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move($destinationPath, $fileName);

            // Delete old icon if exists
            if ($eventType->type_icon && file_exists(public_path($eventType->type_icon))) {
                unlink(public_path($eventType->type_icon));
            }

            // Store new file path
            $eventType->type_icon = 'uploads/events/types/' . $fileName;
        }

        // Update other fields
        $eventType->type_name   = $request->type_name;
        $eventType->type_href   = Str::slug($request->type_name); // Update href if name changes
        $eventType->type_status = $request->type_status;
        $eventType->type_desc   = $request->type_desc;
        $eventType->id_modify  = Auth::id();
        $eventType->date_modify = now();
        
        // Save changes
        $eventType->save();

        return redirect('/event-types')->with('success', 'Event type updated successfully!');
    }

    // Vendor Types Management
    public function vendor_types($action = "list", $href = null)
    {
        if ($action == "edit" && isset($href)) {
            $vendorType = DB::table('vendor_types')->where('type_href', $href)->first();
            return view('admin.vendor_types', compact('action', 'vendorType'));
        } else {
            $vendorTypes = DB::table('vendor_types')
                ->select('type_id', 'type_name', 'type_status', 'type_icon', 'type_href')
                ->where('type_status', '1')
                ->where('is_deleted', 0)
                ->paginate(10);
            return view('admin.vendor_types', compact('action', 'vendorTypes'));
        }
    }

    public function addVendorType(Request $request)
    {
        $request->validate([
            'type_name'   => 'required|string|max:255',
            'type_status' => 'required|in:1,2',
            'type_desc'   => 'nullable|string|max:500',
            'type_icon'   => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        $iconPath = null;
        if ($request->hasFile('type_icon')) {
            $file = $request->file('type_icon');
            $destinationPath = public_path('uploads/vendors/types');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move($destinationPath, $fileName);
            $iconPath = 'uploads/vendors/types/' . $fileName;
        }

        VendorType::create([
            'type_name'   => $request->type_name,
            'type_href'   => Str::slug($request->type_name),
            'type_status' => $request->type_status,
            'type_desc'   => $request->type_desc,
            'type_icon'   => $iconPath,
            'id_added'    => Auth::id(),
            'date_added'  => now(),
        ]);

        return redirect('/vendor-types')->with('success', 'Vendor type added successfully!');
    }

    public function editVendorType(Request $request, $href)
    {
        $vendorType = VendorType::where('type_href', $href)->firstOrFail();

        $request->validate([
            'type_name'   => 'required|string|max:255',
            'type_status' => 'required|in:1,2',
            'type_desc'   => 'nullable|string|max:500',
            'type_icon'   => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        if ($request->hasFile('type_icon')) {
            $file = $request->file('type_icon');
            $destinationPath = public_path('uploads/vendors/types');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move($destinationPath, $fileName);

            if ($vendorType->type_icon && file_exists(public_path($vendorType->type_icon))) {
                unlink(public_path($vendorType->type_icon));
            }

            $vendorType->type_icon = 'uploads/vendors/types/' . $fileName;
        }

        $vendorType->type_name   = $request->type_name;
        $vendorType->type_href   = Str::slug($request->type_name);
        $vendorType->type_status = $request->type_status;
        $vendorType->type_desc   = $request->type_desc;
        $vendorType->id_modify   = Auth::id();
        $vendorType->date_modify = now();
        $vendorType->save();

        return redirect('/vendor-types')->with('success', 'Vendor type updated successfully!');
    }

    public function adminLogin(){
        return view('admin.login');
    }
    public function profile(){
        $user = User::where('id', Auth::id(), )->first(); // Fetch user data using model

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
