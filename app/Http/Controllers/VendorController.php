<?php

namespace App\Http\Controllers;

use App\Models\VendorService;
use App\Models\VendorType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    public function index(){
        return view('vendor.dashboard');
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

    
    public function vendor_signup(){
        return view('vendor.signup');
    }
}
