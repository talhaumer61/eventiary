<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Event;
use App\Models\EventOrganizerAssignment;
use App\Models\EventVendorAssignment;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class clientController extends Controller
{
    public function index(){
        return view('client.dashboard');
    }
    public function create_event()
    {
        $eventTypes = DB::table('event_types')
        ->where('type_status', 1)
        ->where('is_deleted', 0)
        ->get();

        return view('client.create_event', ['eventTypes' => $eventTypes]);
    }

    // add new event
    public function store_event(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'event_name' => 'required|string|max:255',
            'id_type' => 'required|numeric',
            'event_location' => 'required|string|max:255',
            'no_of_guests' => 'nullable|integer|min:0',
            'event_budget' => 'nullable|numeric|min:0',
            'event_date' => 'nullable|date',
            'event_detail' => 'nullable|string',
            'event_image' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        // Generate random event_href
        $eventHref = Str::random(12);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('event_image')) {
            $image = $request->file('event_image');
            $fileName = time() . '_' . Str::slug($request->event_name) . '.' . $image->getClientOriginalExtension();
            $destination = public_path('uploads/events');
            $image->move($destination, $fileName);
            $imagePath = 'uploads/events/' . $fileName;
        }

        // Create new Event record
        Event::create([
            'event_status'   => 1,
            'event_name'     => $request->event_name,
            'event_href'     => $eventHref,
            'event_location' => $request->event_location,
            'event_detail'   => $request->event_detail,
            'event_budget'   => $request->event_budget,
            'no_of_guests'   => $request->no_of_guests,
            'event_date'     => $request->event_date,
            'event_image'    => $imagePath,
            'id_type'        => $request->id_type,
            'id_added'       => Auth::id(),
            'date_added'     => now(),
        ]);

        // Redirect back with success message
        sessionMsg('success', 'Event Created', 'success');
        return redirect()->back();
        
    }

    // update a event
    public function update_event(Request $request, $event_href)
    {
        // Validate request
        $request->validate([
            'event_name' => 'required|string|max:255',
            'id_type' => 'required|numeric',
            'event_location' => 'required|string|max:255',
            'no_of_guests' => 'nullable|integer|min:0',
            'event_budget' => 'nullable|numeric|min:0',
            'event_date' => 'nullable|date',
            'event_detail' => 'nullable|string',
            'event_image' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        // Fetch existing event
        $event = Event::where('event_href', $event_href)->firstOrFail();

        // Handle image upload if new image provided
        if ($request->hasFile('event_image')) {
            // Delete old image if exists
            if ($event->event_image && file_exists(public_path($event->event_image))) {
                unlink(public_path($event->event_image));
            }

            $image = $request->file('event_image');
            $fileName = time() . '_' . Str::slug($request->event_name) . '.' . $image->getClientOriginalExtension();
            $destination = public_path('uploads/events');
            $image->move($destination, $fileName);
            $event->event_image = 'uploads/events/' . $fileName;
        }

        // Update fields
        $event->event_name     = $request->event_name;
        $event->event_location = $request->event_location;
        $event->event_detail   = $request->event_detail;
        $event->event_budget   = $request->event_budget;
        $event->no_of_guests   = $request->no_of_guests;
        $event->event_date     = $request->event_date;
        $event->id_type        = $request->id_type;

        $event->save();

        // Redirect with success
        sessionMsg('success', 'Event Updated', 'success');
        return redirect('/my-events');
    }


    public function my_events($event_href = null)
    {
        $userId = Auth::id();

        if ($event_href) {
            $event = DB::table('events')
                ->where('event_href', $event_href)
                ->where('id_added', $userId)
                ->where('is_deleted', false)
                ->first();

            if (!$event) {
                abort(404); // or redirect with error message
            }
            $eventTypes = DB::table('event_types')
            ->where('type_status', 1)
            ->where('is_deleted', 0)
            ->get();
            return view('client.my_events', compact('event','eventTypes'));
        } else {
            $myEvents = DB::table('events')
                ->where('id_added', $userId)
                ->where('is_deleted', false)
                ->paginate(10);

            return view('client.my_events', compact('myEvents'));
        }
    }

    public function guests($action = "list", $href = null)
    {
        // Fetch events that are active and not deleted
        $events = DB::table('events')
            ->where('event_status', 1)
            ->where('is_deleted', 0)
            ->get();

        // Fetch events that have guests associated with them
        $guestsGroupedByEvent = DB::table('events')
        ->join('guests', 'events.event_id', '=', 'guests.id_event')
        ->where('guests.is_deleted', 0)
        ->where('guests.status', 1)
        ->where('events.event_status', 1)
        ->where('events.is_deleted', 0)
        ->select('events.event_id', 'events.event_name', 'guests.*') // Selecting required columns
        ->orderBy('events.event_id')
        ->get()
        ->groupBy('event_id'); // Group guests by event_id

        // Check if there are any events with guests
        if ($guestsGroupedByEvent->isEmpty()) {
            $guestsGroupedByEvent=null;
            // If no guests are found, return a message or redirect accordingly
            return view('client.guests', compact('action', 'events', 'guestsGroupedByEvent'))->with('message', 'No events with guests found.');
        }

        if ($action == "edit" && $href) {
            $guest = DB::table('guests')
                    ->where('href', $href)
                    ->where('is_deleted', 0)
                    ->first();
            return view('client.guests', compact('action', 'events','guest'));
        } else {
            return view('client.guests', compact('action', 'events', 'guestsGroupedByEvent'));
        }
    }


    // add guest
    public function storeGuest(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'id_event'  => 'required|exists:events,event_id',
            'address'   => 'nullable|string|max:255',
            'photo'     => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        $photoPath = null;

        if ($request->hasFile('photo')) {
            $fileName = time() . '_' . Str::random(10) . '.' . $request->photo->extension();
            $uploadPath = 'uploads/guests';
            $request->photo->move(public_path($uploadPath), $fileName);
            $photoPath = $uploadPath . '/' . $fileName; // Full relative path
        }

        DB::table('guests')->insert([
            'status'      => 1,
            'name'        => $request->name,
            'address'     => $request->address,
            'photo'       => $photoPath,
            'id_event'    => $request->id_event,
            'href'        => Str::random(12),
            'id_added'    => Auth::id(),
            'date_added'  => now(),
            'is_deleted'  => 0,
        ]);

        sessionMsg('success', 'Guest Added', 'success');
        return redirect('/guests');
    }

    // edit guest
    public function updateGuest(Request $request, $href)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'id_event'  => 'required|exists:events,event_id',
            'address'   => 'nullable|string|max:255',
            'photo'     => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        $guest = DB::table('guests')->where('href', $href)->first();

        if (!$guest) {
            return redirect('/guests')->with('error', 'Guest not found.');
        }

        $photoPath = $guest->photo; // Keep old photo if new one not uploaded

        if ($request->hasFile('photo')) {
            $fileName = time() . '_' . Str::random(10) . '.' . $request->photo->extension();
            $uploadPath = 'uploads/guests';
            $request->photo->move(public_path($uploadPath), $fileName);
            $photoPath = $uploadPath . '/' . $fileName; // Consistent path format
        }

        DB::table('guests')->where('href', $href)->update([
            'name'       => $request->name,
            'address'    => $request->address,
            'photo'      => $photoPath,
            'id_event'   => $request->id_event,
            'date_added' => now(),
        ]);

        sessionMsg('success', 'Guest updated successfully', 'success');
        return redirect('/guests');
    }

    // Selected Organizers
    public function my_organizers()
    {
        $clientId = Auth::user()->id; // or auth('client')->id();

        // Get all events created by the logged-in client
        $events = Event::where('id_added', $clientId)->get();

        // Get all users with type = 3 (organizers)
        $organizers = User::where('login_type', 3)->get();

        // Fetch assignments with related event and organizer data
        $assignments = EventOrganizerAssignment::with(['event', 'organizer'])
            ->where('client_id', $clientId)
            ->where('is_deleted', 0)
            ->get();

        return view('client.my_organizers', compact('events', 'organizers', 'assignments'));

    }

    public function assignOrganizer(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,event_id',
            'organizer_id' => 'required|exists:users,id',
            'description' => 'nullable|string|max:1000',
        ]);

        $clientId = Auth::id();

        // Check if assignment already exists
        $existing = EventOrganizerAssignment::where('client_id', $clientId)
            ->where('event_id', $request->event_id)
            ->where('organizer_id', $request->organizer_id)
            ->where('is_deleted', null)
            ->first();

        if ($existing) {
            sessionMsg('Error', 'You have already requested this organizer for the selected event.', 'danger');
            return redirect()->back();
        }

        // Create new assignment
        EventOrganizerAssignment::create([
            'client_id' => $clientId,
            'event_id' => $request->event_id,
            'organizer_id' => $request->organizer_id,
            'status' => EventOrganizerAssignment::STATUS_PENDING,
            'description' => $request->description,
        ]);

        sessionMsg('Success', 'Organizer assigned successfully! Waiting for response.', 'success');
        return redirect()->back();
    }

    public function my_vendors()
    {
        $clientId = Auth::user()->id;

        // Events created by client
        $events = Event::where('id_added', $clientId)->get();

        // All vendors
        $vendors = User::where('login_type', 4)->get();

        // Assignments made by client
        $assignments = EventVendorAssignment::with(['event', 'vendor', 'service'])
            ->where('client_id', $clientId)
            ->where('is_deleted', 0)
            ->get();

        return view('client.my_vendors', compact('events', 'vendors', 'assignments'));
    }

    public function assignVendor(Request $request)
    {
        $request->validate([
            'event_id'    => 'required|exists:events,event_id',
            'vendor_id'   => 'required|exists:users,id',
            'service_id'  => 'required|exists:vendor_services,service_id',
            'description' => 'nullable|string|max:1000',
        ]);

        $clientId = Auth::id();

        // Prevent duplicate request
        $existing = EventVendorAssignment::where('client_id', $clientId)
            ->where('event_id', $request->event_id)
            ->where('vendor_id', $request->vendor_id)
            ->where('service_id', $request->service_id)
            ->where('is_deleted', 0)
            ->first();

        if ($existing) {
            sessionMsg('Error', 'You have already requested this vendor for the selected service and event.', 'danger');
            return back();
        }

        EventVendorAssignment::create([
            'client_id'   => $clientId,
            'event_id'    => $request->event_id,
            'vendor_id'   => $request->vendor_id,
            'service_id'  => $request->service_id,
            'status'      => 3,
            'description' => $request->description,
            'id_added'    => $clientId,
            'date_added'  => now(),
        ]);

        sessionMsg('Success', 'Vendor request sent successfully!', 'success');
        return redirect()->back();
    }



    public function user_messages(){
        return view('client.user_messages');
    }
    public function payments()
    {
        $userId = Auth::id();

        $payments = DB::table('payments')
            ->leftJoin('users as receiver', 'receiver.id', '=', 'payments.id_to')
            ->leftJoin('users as payer', 'payer.id', '=', 'payments.id_from')
            ->select(
                'payments.*',
                'receiver.name as receiver_name',
                'receiver.email as receiver_email',
                'receiver.photo as receiver_photo',
                'payer.name as payer_name',
                'payer.email as payer_email'
            )
            ->where('payments.id_from', $userId)
            ->orderBy('payments.paid_at', 'desc')
            ->paginate(10);

        return view('client.payments', compact('payments'));
    }

    public function budget_tracking(){
        return view('client.budget_tracking');
    }
    public function profile(){
        $user = User::where('id', Auth::user()->id)->first(); // Fetch user data using model

        return view('client.profile', compact('user'));
    }
    
    public function submitReview(Request $request)
{
    $request->validate([
        'assignment_id' => 'required|exists:event_organizer_assignments,id',
        'from' => 'required|exists:users,id',
        'to' => 'required|exists:users,id',
        'rating' => 'required|integer|min:1|max:5',
        'review' => 'required|string'
    ]);

    // Insert review
    Review::create([
        'assignment_id' => $request->assignment_id,
        'from' => $request->from,
        'to' => $request->to,
        'rating' => $request->rating,
        'review' => $request->review,
    ]);

    // Update assignment status → 4 = Completed
    DB::table('event_organizer_assignments')
        ->where('id', $request->assignment_id)
        ->update(['status' => 4]);

    sessionMsg('success', 'Review submitted successfully!', 'success');
    return back();
}

public function submitVendorReview(Request $request)
{
    $request->validate([
        'assignment_id' => 'required|exists:event_vendor_assignments,id',
        'from' => 'required|exists:users,id',
        'to'   => 'required|exists:users,id',
        'rating' => 'required|integer|min:1|max:5',
        'review' => 'required|string'
    ]);

    // Insert review
    Review::create([
        'assignment_id' => $request->assignment_id,
        'from' => $request->from,
        'to'   => $request->to,
        'rating' => $request->rating,
        'review' => $request->review,
    ]);

    // Mark vendor assignment as completed (status = 4)
    DB::table('event_vendor_assignments')
        ->where('id', $request->assignment_id)
        ->update(['status' => 4]);

    sessionMsg('success', 'Vendor Review submitted successfully!', 'success');
    return back();
}




    

    
}
