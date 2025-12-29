<?php

namespace App\Http\Controllers;

use App\Models\EventOrganizerAssignment;
use App\Models\EventVendorAssignment;
use App\Models\User;
use App\Models\VendorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class organizerController extends Controller
{
    public function index(){
        $organizerId = auth()->id();

        $assignments = \App\Models\EventOrganizerAssignment::where('organizer_id', $organizerId)->count();
        $payments = \App\Models\Payment::where('id_to', $organizerId)->count();
        $portfolio = \App\Models\OrganizerPortfolio::where('organizer_id', $organizerId)->count();
        $team = \App\Models\OrganizerTeamMember::where('organizer_id', $organizerId)->count();

        return view('organizer.dashboard', compact('assignments', 'payments', 'portfolio', 'team'));
    }
    public function my_bookings(){
        $organizerId = Auth::id(); // get currently logged-in organizer
        $assignments = EventOrganizerAssignment::with(['event', 'client']) // eager load relations if defined
            ->where('organizer_id', $organizerId)
            ->where('is_deleted', false)
            ->whereIn('status', [1]) // status 2 = rejected, 3 = pending
            ->orderBy('id', 'desc')
            ->get();

        return view('organizer.my_bookings', compact('assignments'));
    }
    public function booking_requests()
    {
        $organizerId = Auth::id(); // get currently logged-in organizer
        $assignments = EventOrganizerAssignment::with(['event', 'client']) // eager load relations if defined
            ->where('organizer_id', $organizerId)
            ->where('is_deleted', false)
            ->whereIn('status', [2, 3]) // status 2 = rejected, 3 = pending
            ->orderBy('id', 'desc')
            ->get();

        return view('organizer.booking_requests', compact('assignments'));
    }
    public function requestAction(Request $request)
    {
        $request->validate([
            'assignment_id' => 'required|exists:event_organizer_assignments,id',
            'action' => 'required|in:accept,reject',
        ]);

        $assignment = EventOrganizerAssignment::find($request->assignment_id);

        $assignment->status = $request->action === 'accept' ? 1 : 2;
        $assignment->id_modify = Auth::id();
        $assignment->date_modify = now();

        // If organizer accepts → set payment pending
        if ($request->action === 'accept') {
            $assignment->payment_status = 'pending';
        }

        $assignment->save();

        return back()->with('success', 'Request has been ' . $request->action . 'ed.');
    }


    public function vendors()
    {
        $vendors = User::where('login_type', 4)->get();

        $assignments = EventOrganizerAssignment::with('event')
            ->where('organizer_id', Auth::id())
            ->where('status', 1)
            ->get();

        $requests = EventVendorAssignment::with(['event', 'vendor','service'])
        ->where('client_id', Auth::id())
        ->where('is_deleted', 0)
        ->get();

        return view('organizer.vendors', compact('vendors', 'assignments', 'requests'));
    }

    public function getVendorServices($vendorId)
    {
        $services = VendorService::where('id_vendor', $vendorId)->get();

        return response()->json($services);
    }

    public function submitVendorAssignment(Request $request)
    {
        $request->validate([
            'vendor_id'   => 'required|exists:users,id',
            'service_id'  => 'required|exists:vendor_services,service_id', // validate service too
            'event_id'    => 'required|exists:events,event_id',
            'description' => 'nullable|string|max:1000',
        ]);

        $exists = EventVendorAssignment::where('vendor_id', $request->vendor_id)
            ->where('service_id', $request->service_id)
            ->where('event_id', $request->event_id)
            ->where('client_id', Auth::id())
            ->exists();

        if ($exists) {
            sessionMsg('Error', 'You have already submitted this request for this vendor and service.', 'danger');
            return back()->withErrors(['error' => 'You have already submitted this request for this vendor and service.']);
        }

        $assignment = new EventVendorAssignment();
        $assignment->vendor_id   = $request->vendor_id;
        $assignment->service_id  = $request->service_id;
        $assignment->event_id    = $request->event_id;
        $assignment->client_id   = Auth::id(); // organizer
        $assignment->status      = 3; // Pending
        $assignment->description = $request->description;
        $assignment->id_added    = Auth::id();
        $assignment->date_added  = now();

        $assignment->save();

        sessionMsg('Success', 'Vendor assignment request submitted successfully.', 'success');
        return redirect('/my-vendors')->with('success', 'Vendor assignment request submitted successfully.');
    }


    public function profile(){
        return view('organizer.profile');
    }

    public function payments($type = "received")
    {
        $userId = auth()->id();

        if ($type == "sent") {

            // Payments SENT by organizer
            $payments = DB::table('payments')
                ->where('id_from', $userId)
                ->leftJoin('users', 'payments.id_to', '=', 'users.id')
                ->select(
                    'payments.*',
                    'users.name as receiver_name',
                    'users.email as receiver_email',
                    'users.photo as receiver_photo'
                )
                ->orderBy('payments.id', 'desc')
                ->get();

        } else {

            // Payments RECEIVED by organizer
            $payments = DB::table('payments')
                ->where('id_to', $userId)
                ->leftJoin('users', 'payments.id_from', '=', 'users.id')
                ->select(
                    'payments.*',
                    'users.name as receiver_name',
                    'users.email as receiver_email',
                    'users.photo as receiver_photo'
                )
                ->orderBy('payments.id', 'desc')
                ->get();
        }

        return view('organizer.payments', compact('payments', 'type'));
    }


}
