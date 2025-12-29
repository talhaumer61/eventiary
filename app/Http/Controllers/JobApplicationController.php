<?php
namespace App\Http\Controllers;

use App\Models\EventJob;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobApplicationController extends Controller
{
    public function apply(Request $request, $jobId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'cover_letter' => 'required|string',
        ]);

        JobApplication::create([
            'job_id' => $jobId,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'cover_letter' => $request->cover_letter,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Your application has been submitted successfully!');
    }
}
