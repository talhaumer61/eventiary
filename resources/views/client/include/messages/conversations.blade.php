@forelse ($conversations as $convo)
    <div class="p-2 border-bottom open-chat" style="cursor: pointer;"
         data-id="{{ $convo->other_user_id }}" data-event-id="{{ $convo->event_id }}">
        <strong>{{ $convo->other_user->name }}</strong><br>
        <small class="text-muted">
            {{ Str::limit($convo->latest_message, 40) }}
            <span class="float-end">{{ \Carbon\Carbon::parse($convo->created_at)->diffForHumans() }}</span>
        </small>
    </div>
@empty
    <div class="p-3 text-muted">No conversations yet.</div>
@endforelse
