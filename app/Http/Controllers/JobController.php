<?php
namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Event;
use App\Models\EventJob;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    public function index( $action = 'list', EventJob $job = null)
    {
        if($action == 'show'){
            $job->load('event', 'user', 'applications.applicant');
            return view('client.my_jobs', compact('job', 'action'));
        }
        elseif($action == 'manage'){
            $jobs = EventJob::where('user_id', Auth::id())->with('applications.applicant')->get();
            return view('client.my_jobs', compact('jobs', 'action'));
        } 
        elseif($action == 'create'){
            $events = Event::where('id_added', Auth::id())->get();
            return view('client.my_jobs', compact('action', 'events'));
        }
        else {
            $jobs = EventJob::with('event', 'user')->where('status', 'open')->latest()->paginate(10);
            return view('client.my_jobs', compact('jobs', 'action'));
        }
    }
    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,event_id',
            'title' => 'required|string|max:255',
            'description' => 'required',
        ]);

        // Generate SEO-friendly href from title
        $href = Str::slug($request->title);

        // Ensure uniqueness (optional but recommended)
        $count = \App\Models\EventJob::where('href', 'LIKE', "{$href}%")->count();
        if ($count > 0) {
            $href .= '-' . ($count + 1);
        }

        EventJob::create([
            'event_id'   => $request->event_id,
            'user_id'    => Auth::id(),
            'title'      => $request->title,
            'description'=> $request->description,
            'location'   => $request->location,
            'href'       => $href, // ✅ added SEO URL
        ]);

        sessionMsg('Success', 'Job posted successfully.', 'success');
        return redirect()->route('jobs.index');
    }
    
    public function applications($jobId)
{
    $applications = DB::table('job_applications')
        ->select('*') // fetch ALL columns
        ->where('job_id', $jobId)
        ->orderBy('created_at', 'desc')
        ->get();

    return response()->json($applications);
}

}
