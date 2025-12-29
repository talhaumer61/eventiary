<?php

namespace App\Http\Controllers;

use App\Models\EventOrganizerAssignment;
use App\Models\EventVendorAssignment;
use App\Models\VendorService;
use App\Models\VendorType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VendorController extends Controller
{
    public function index()
    {
        $vendorId = auth()->id();
        // pushNotification(
        //     $vendorId,
        //     "Welcome",
        //     "Welcome to your Vendor Dashboard!"
        // );


        // Total services created by this vendor
        $totalServices = \App\Models\VendorService::where('id_vendor', $vendorId)
                            ->where('is_deleted', 0)
                            ->count();

        // Total assignments
        $assignments = \App\Models\EventVendorAssignment::where('vendor_id', $vendorId)
                            ->where('is_deleted', 0)
                            ->count();

        // Reviews Received
        $reviews = \App\Models\Review::where('to', $vendorId)->count();

        // Average Rating
        $avgRating = \App\Models\Review::where('to', $vendorId)->avg('rating');
        $avgRating = $avgRating ? number_format($avgRating, 1) : 0;

        // Payments Received (optional)
        $totalPayments = \App\Models\Payment::where('id_to', $vendorId)->sum('amount_transferred');

        return view('vendor.dashboard', compact(
            'totalServices',
            'assignments',
            'reviews',
            'avgRating',
            'totalPayments'
        ));
    }

    public function my_services($action = 'list', $href = null)
    {
        $vendorId = Auth::user()->id;

        $services = VendorService::where('id_vendor', $vendorId)
            ->where('is_deleted', false)
            ->get();

        $types = VendorType::where('is_deleted', false)
            ->where('type_status', 1)
            ->get();

        $editService = null;

        if ($action == 'edit' && $href) {
            $editService = VendorService::where('service_href', $href)
                ->where('id_vendor', $vendorId)
                ->where('is_deleted', false)
                ->first();

            if (!$editService) {
                return redirect()->back()->with('error', 'Service not found or unauthorized access.');
            }
        }

        return view('vendor.my_services', compact('action', 'href', 'services', 'types', 'editService'));
    }


    public function store_service(Request $request)
    {
        // Validate inputs
        $request->validate([
            'service_name'  => 'required|string|max:255',
            'id_type'       => 'required|integer|exists:vendor_types,type_id',
        ]);

        // Prepare data
        $data = [
            'service_name'   => $request->service_name,
            'id_type'        => $request->id_type,
            'service_desc'   => $request->service_desc,
            'service_price'  => $request->service_price,
            'service_status' => $request->service_status,
            'id_vendor'      => Auth::id(),
            'service_href'   => Str::slug($request->service_name) . '-' . uniqid(),
            'date_added'     => now(),
        ];

        // Handle photo upload
        if ($request->hasFile('service_photo')) {
            $photo = $request->file('service_photo');
            $photoName = time() . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photoPath = 'uploads/vendors/services';

            // Create the directory if it doesn't exist
            if (!file_exists(public_path($photoPath))) {
                mkdir(public_path($photoPath), 0755, true);
            }

            $photo->move(public_path($photoPath), $photoName);
            $data['service_photo'] = $photoPath . '/' . $photoName;
        }

        // Save to DB
        VendorService::create($data);

        return redirect('/my-services');
    }


    public function updateService(Request $request, $id)
    {
        $vendorId = Auth::id();
        $service = VendorService::where('id_vendor', $vendorId)->where('service_id', $id)->firstOrFail();

        $request->validate([
            'service_name'   => 'required|string|max:255',
            'id_type'        => 'required|integer',
            'service_desc'   => 'nullable|string',
            'service_price'  => 'required|numeric',
            'service_status' => 'required|in:1,2',
            'service_photo'  => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        $service->service_name   = $request->service_name;
        $service->id_type        = $request->id_type;
        $service->service_desc   = $request->service_desc;
        $service->service_price  = $request->service_price;
        $service->service_status = $request->service_status;

        // Handle new image upload
        if ($request->hasFile('service_photo')) {
            $file = $request->file('service_photo');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/services'), $filename);

            // Optionally delete old file
            if ($service->service_photo && file_exists(public_path('uploads/services/' . $service->service_photo))) {
                unlink(public_path('uploads/services/' . $service->service_photo));
            }

            $service->service_photo = $filename;
        }

        $service->save();

        return redirect()->route('vendor.my_services')->with('success', 'Service updated successfully!');
    }


    public function my_bookings()
    {
        $vendorId = Auth::id();

        $assignments = EventVendorAssignment::with(['event', 'client', 'service']) // load service too
            ->where('vendor_id', $vendorId)
            ->where('is_deleted', false)
            ->where('status', 1) // status 1 = accepted
            ->orderBy('id', 'desc')
            ->get();

        return view('vendor.my_bookings', compact('assignments'));
    }

    public function booking_requests()
    {
        $vendorId = Auth::id(); // get currently logged-in vendor

        $assignments = EventVendorAssignment::with(['event', 'client', 'service']) // eager load event + client
            ->where('vendor_id', $vendorId)
            ->where('is_deleted', false)
            ->whereIn('status', [2, 3]) // status 2 = rejected, 3 = pending
            ->orderBy('id', 'desc')
            ->get();

        return view('vendor.booking_requests', compact('assignments'));
    }

    public function requestAction(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:event_vendor_assignments,id',
            'action' => 'required|in:accept,reject',
        ]);

        $assignment = EventVendorAssignment::find($request->id);
        $assignment->status = $request->action === 'accept' ? 1 : 2;
        $assignment->id_modify = Auth::user()->id;
        $assignment->date_modify = now();
        $assignment->save();

        return back()->with('success', 'Request has been ' . $request->action . 'ed.');
    }

    
    public function vendor_signup(){
        return view('vendor.signup');
    }

    public function profile(){
        return view('vendor.profile');
    }

    public function payments()
    {
        $userId = auth()->id();

       
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

        return view('vendor.payments', compact('payments'));
    }
}
