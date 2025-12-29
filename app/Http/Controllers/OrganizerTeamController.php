<?php

namespace App\Http\Controllers;

use App\Models\OrganizerTeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OrganizerTeamController extends Controller
{
    public function index($action = "list", $id = null)
    {
        if ($action == "add") {
            return view('organizer.team', compact( 'action'));
        } elseif ($action == "edit" && $id) {
            $member = OrganizerTeamMember::findOrFail($id);
            return view('organizer.team', compact('member', 'action'));
        }else{
            $team = OrganizerTeamMember::where('organizer_id', Auth::id())
                ->latest()
                ->paginate(8);

            return view('organizer.team', compact('team', 'action'));
        }
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'designation' => 'required|string',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        $filename = null;

        if ($request->photo) {
            $filename = 'uploads/team/' . time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads/team'), $filename);
        }

        OrganizerTeamMember::create([
            'organizer_id' => Auth::id(),
            'name' => $request->name,
            'designation' => $request->designation,
            'bio' => $request->bio,
            'photo' => $filename,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'linkedin' => $request->linkedin,
        ]);

        session()->flash('success', 'Team member added successfully!');
        return redirect()->route('organizer.team.index');
    }

    public function update(Request $request, $id)
    {
        $member = OrganizerTeamMember::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'bio' => 'nullable',
            'photo' => 'nullable|image|max:2048',
        ]);

        $filename = $member->photo;

        if ($request->photo) {
            if ($filename && file_exists(public_path($filename))) {
                unlink(public_path($filename));
            }
            $filename = 'uploads/team/' . time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads/team'), $filename);
        }

        $member->update([
            'name' => $request->name,
            'designation' => $request->designation,
            'bio' => $request->bio,
            'photo' => $filename,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'linkedin' => $request->linkedin,
        ]);

        session()->flash('success', 'Team member updated!');
        return redirect()->route('organizer.team.index');
    }

    public function destroy($id)
    {
        $member = OrganizerTeamMember::findOrFail($id);

        if ($member->photo && file_exists(public_path($member->photo))) {
            unlink(public_path($member->photo));
        }

        $member->delete();

        session()->flash('success', 'Team member removed!');
        return back();
    }
}
