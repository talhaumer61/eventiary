<?php

namespace App\Http\Controllers;

use App\Models\EventJob;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class SiteJobsController extends Controller
{
    public function index()
    {
        $jobs = EventJob::with('event', 'user')
            ->where('status', 'open')
            ->latest()
            ->get();

        return view('listed_jobs', compact('jobs'));
    }

    public function show(EventJob $job)
    {
        $job->load('event', 'user');
        return response()->json($job); // For modal AJAX
    }

    


}
