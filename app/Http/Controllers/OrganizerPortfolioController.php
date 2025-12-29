<?php

namespace App\Http\Controllers;

use App\Models\OrganizerPortfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizerPortfolioController extends Controller
{
    // LIST
    public function index($action = "list", $id = null) {
        if ($action == "add") {
            return view('organizer.portfolio', compact('action'));
        } elseif ($action == "edit" && $id) {
            $portfolio = OrganizerPortfolio::findOrFail($id);
            return view('organizer.portfolio', compact('portfolio', 'action'));
        }
        else{
            $portfolios = OrganizerPortfolio::where('organizer_id', Auth::id())->latest()->paginate(1);
            return view('organizer.portfolio', compact('portfolios', 'action'));
        }
    }

    // ADD RECORD
    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        // Upload
        $file = $request->file('image');
        $imageName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/portfolio'), $imageName);

        OrganizerPortfolio::create([
            'organizer_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'image' => 'uploads/portfolio/' . $imageName
        ]);

        sessionMsg('Success', 'Portfolio added successfully', 'success');
        return redirect()->route('organizer.portfolio.index');
    }

    // UPDATE RECORD
    public function update(Request $request, OrganizerPortfolio $portfolio) {
        $this->authorizeAccess($portfolio);

        $request->validate([
            'title' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $imageName = $portfolio->image;

        if ($request->hasFile('image')) {
            // Delete old
            if (file_exists(public_path($portfolio->image))) {
                unlink(public_path($portfolio->image));
            }

            $file = $request->file('image');
            $imageName = 'uploads/portfolio/' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/portfolio'), basename($imageName));
        }

        $portfolio->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName
        ]);

        sessionMsg('Success', 'Portfolio updated successfully', 'success');
        return redirect()->route('organizer.portfolio.index');
    }

    // DELETE RECORD
    public function destroy(OrganizerPortfolio $portfolio) {
        $this->authorizeAccess($portfolio);

        if (file_exists(public_path($portfolio->image))) {
            unlink(public_path($portfolio->image));
        }

        $portfolio->delete();

        sessionMsg('Success', 'Portfolio item deleted', 'success');
        return back();
    }

    // SECURITY
    private function authorizeAccess($portfolio) {
        if ($portfolio->organizer_id != Auth::id()) {
            abort(403, "Unauthorized");
        }
    }
}
