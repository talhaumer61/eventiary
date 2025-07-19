<div id="chat-box" class="p-3" style="height: 400px; overflow-y: scroll; background: #f9f9f9;">
    <!-- Messages will be loaded here by AJAX -->
</div>

<form id="chat-form">
    @csrf
    <input type="hidden" name="receiver_id" id="chat-receiver-id" value="{{ $receiver->id }}">
    <input type="hidden" name="event_id"    id="chat-event-id"    value="{{ $event_id }}">


    
    <div class="input-group">
        <input type="text" name="message" class="form-control" placeholder="Type your message" required>
        <button type="submit" class="btn btn-primary">Send</button>
    </div>
</form>


