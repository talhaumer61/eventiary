<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    // 1. Show main chat page (inbox + chat panel)
    public function index(Request $request)
    {
        $user = Auth::user();

        $conversations = Message::where('sender_id', $user->id)
            ->orWhere('receiver_id', $user->id)
            ->latest()
            ->get()
            ->groupBy(fn($msg) => $msg->sender_id == $user->id ? $msg->receiver_id . '-' . $msg->event_id : $msg->sender_id . '-' . $msg->event_id)
            ->map(function ($msgs) use ($user) {
                $last = $msgs->first();
                return (object)[
                    'other_user_id' => $last->sender_id == $user->id ? $last->receiver_id : $last->sender_id,
                    'event_id' => $last->event_id,
                    'latest_message' => $last->message,
                    'created_at' => $last->created_at,
                    'other_user' => $last->sender_id == $user->id ? $last->receiver : $last->sender,
                ];
            });

        $preselectedUser = $request->filled('receiver_id') ? User::find($request->receiver_id) : null;

        return view('client.user_messages', [
            'conversations' => $conversations,
            'receiver_id' => $request->receiver_id,
            'event_id' => $request->event_id,
            'preselectedUser' => $preselectedUser,
        ]);
    }

    // 2. Send new message (AJAX)
    public function sendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string|max:5000',
        ]);

        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'event_id' => $request->event_id,
            'message' => $request->message,
            'seen' => false,
        ]);

        return response()->json(['success' => true]);
    }

    // 3. Fetch messages between 2 users (AJAX)
    public function fetchMessages(Request $request)
    {
        $query = Message::query()
            ->where(function ($q) use ($request) {
                $q->where('sender_id', Auth::user()->id)
                ->where('receiver_id', $request->receiver_id);
            })
            ->orWhere(function ($q) use ($request) {
                $q->where('sender_id', $request->receiver_id)
                ->where('receiver_id', Auth::user()->id);
            });

        if ($request->event_id) {
            $query->where('event_id', $request->event_id);
        } else {
            $query->whereNull('event_id');
        }

        if ($request->filled('last_id')) {
            $query->where('id', '>', $request->last_id);
        }

        return response()->json($query->orderBy('id')->get());
    }



    // 4. Render right-side chat panel (HTML partial via AJAX)
    public function chatBox(Request $request)
    {
        $user = Auth::user();
        $receiver_id = $request->receiver_id;
        $event_id = $request->event_id;

        $receiver = \App\Models\User::findOrFail($receiver_id);

        // Get messages (optional, if you're not loading them via AJAX yet)
        $messages = Message::where(function ($q) use ($user, $receiver_id) {
            $q->where('sender_id', $user->id)
            ->where('receiver_id', $receiver_id);
        })->orWhere(function ($q) use ($user, $receiver_id) {
            $q->where('sender_id', $receiver_id)
            ->where('receiver_id', $user->id);
        });

        if ($event_id) {
            $messages->where('event_id', $event_id);
        }

        $messages = $messages->orderBy('created_at')->get();

        return view('client.include.messages.messages', compact('receiver', 'event_id', 'messages'));
    }


    public function startConversation(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'event_id' => 'nullable|integer'
        ]);

        $sender_id = Auth::user()->id;
        $receiver_id = $request->receiver_id;
        $event_id = $request->event_id;

        // Check if conversation already exists
        $exists = Message::where(function ($query) use ($sender_id, $receiver_id, $event_id) {
            $query->where('sender_id', $sender_id)
                ->where('receiver_id', $receiver_id)
                ->when($event_id, fn($q) => $q->where('event_id', $event_id));
        })->orWhere(function ($query) use ($sender_id, $receiver_id, $event_id) {
            $query->where('sender_id', $receiver_id)
                ->where('receiver_id', $sender_id)
                ->when($event_id, fn($q) => $q->where('event_id', $event_id));
        })->exists();

        if (!$exists) {
            Message::create([
                'sender_id' => $sender_id,
                'receiver_id' => $receiver_id,
                'event_id' => $event_id,
                'message' => '(Conversation started)',
                'seen' => false
            ]);
        }

        return redirect()->route('chat.index', [
            'receiver_id' => $receiver_id,
            'event_id' => $event_id
        ]);
    }

}
