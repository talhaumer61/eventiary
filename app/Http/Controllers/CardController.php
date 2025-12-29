<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CardController extends Controller
{
    public function my_cards($eventId = null)
    {
        $userId = Auth::id();

        $cards = Card::with('event')
            ->whereHas('event', function ($q) use ($userId) {
                $q->where('id_added', $userId);
            })
            ->latest()
            ->get();

        return view('client.cards', compact('cards', 'eventId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,event_id',
            'card_data' => 'required|array',
        ]);

        // 🔹 Delete old card if exists for same event
        $oldCard = Card::where('event_id', $request->event_id)->first();
        if ($oldCard) {
            // Delete image file if exists
            if ($oldCard->image_path && file_exists(public_path($oldCard->image_path))) {
                unlink(public_path($oldCard->image_path));
            }
            $oldCard->delete();
        }

        // 🔹 Save new image if provided
        $path = null;
        if ($request->has('image_base64')) {
            $image = $request->input('image_base64');
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);

            $folder = public_path('uploads/cards');
            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }

            $imageName = uniqid() . '.png';
            file_put_contents($folder . '/' . $imageName, base64_decode($image));
            $path = 'uploads/cards/' . $imageName;
        }

        // 🔹 Create new card
        $card = Card::create([
            'event_id'         => $request->event_id,
            'template'         => $request->template ?? 'minimal',
            'background_color' => $request->background_color,
            'font_family'      => $request->font_family,
            'text_color'       => $request->text_color,
            'image_path'       => $path,
            'card_data'        => $request->card_data,
        ]);

        sessionMsg('Success', 'Card created successfully!', 'success');
        return redirect()->route('my.cards');
    }


    public function share(Request $request)
    {
        $request->validate([
            'card_id' => 'required|exists:cards,id',
            'email'   => 'required|email',
            'name'    => 'nullable|string|max:100',
        ]);

        $card = Card::with('event')->findOrFail($request->card_id);

        $email = $request->email;
        $name = $request->name ?: 'Guest';

        // You can customize subject/content
        $subject = "You're Invited: {$card->event->event_name}";
        $content = "
            <h2 style='font-family:sans-serif;'>Hi {$name},</h2>
            <p>You’ve been invited to the event <strong>{$card->event->event_name}</strong>!</p>
            <p>Here’s your invitation card:</p>
            <img src='" . asset($card->image_path) . "' alt='Event Card' style='max-width:100%;border-radius:10px;margin:10px 0;'>
            <p>We hope to see you there!<br><br><b>- Eventiary Team</b></p>
        ";

        $wasSent = sendEmail($email, $subject, $content);

        if ($wasSent) {
            sessionMsg('Success', 'Card shared successfully with ' . $email, 'success');
            return redirect()->back();
        } else {
            return redirect()->back()->with('error', 'Could not send the email. Please try again.');
        }
    }


    public function show(Card $card)
    {
        return view('cards.show', compact('card'));
    }
}
