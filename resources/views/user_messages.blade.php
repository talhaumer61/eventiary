@php
    $loginType = Auth::user()->login_type ?? null;
@endphp

@if($loginType === 2)
    @include('client.header', ['page_title' => 'Messages'])
@elseif($loginType === 3)
    @include('organizer.header', ['page_title' => 'Messages'])
@elseif($loginType === 4)
    @include('vendor.header', ['page_title' => 'Messages'])
@endif


<div class="container mt-4">
    <div class="row">
        <!-- Left: Conversations -->
        <div class="col-md-4 border-end" id="conversation-list">
            @include('include.messages.conversations')
        </div>

        <!-- Right: Chat panel -->
        <div class="col-md-8" id="chat-panel">
            <p class="text-muted p-4">Select a conversation to start chatting</p>
        </div>
    </div>
</div>

@push('scripts')
@if(!empty($receiver_id))
    <script>
        $(document).ready(function () {
            loadMessages('{{ $receiver_id }}', '{{ $event_id ?? '' }}');
        });
    </script>
@endif

<script>
    let lastMessageId = 0;

    function fetchMessages() {
        const receiverId = $('#chat-receiver-id').val();
        const eventId = $('#chat-event-id').val();

        if (!receiverId) return;

        $.ajax({
            url: '{{ route("messages.fetch") }}',
            type: 'GET',
            data: {
                receiver_id: receiverId,
                event_id: eventId,
                last_id: lastMessageId
            },
            success: function (data) {
                if (data.length === 0) return;
                const chatBox = $('#chat-box');
                const isAtBottom = chatBox[0].scrollTop + chatBox[0].clientHeight >= chatBox[0].scrollHeight - 20;

                data.forEach(msg => {
                    if (msg.id > lastMessageId) {
                        const side = msg.sender_id == {{ auth()->id() }} ? 'right' : 'left';
                        const bubbleClass = side === 'right' ? 'bg-primary text-white ms-auto' : 'bg-secondary text-light me-auto';
                        $('#chat-box').append(`
                            <div class="d-flex flex-column ${side === 'right' ? 'align-items-end' : 'align-items-start'} my-2">
                                <div class="p-2 rounded-pill ${bubbleClass}" style="max-width: 75%; word-break: break-word;">
                                    ${msg.message}
                                </div>
                            </div>
                        `);
                        lastMessageId = msg.id;
                    }
                });

                // $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
                if (isAtBottom) {
                chatBox.scrollTop(chatBox[0].scrollHeight);
            }
            }
        });
    }

    function loadMessages(receiverId, eventId = '') {
        lastMessageId = 0;

        $.get('{{ route("chat.box") }}', {
            receiver_id: receiverId,
            event_id: eventId
        }, function (data) {
            $('#chat-panel').html(data);

            // Now wait 100ms for DOM to fully render before fetching messages
            setTimeout(() => {
                $('#chat-box').html(''); // clear messages first
                fetchMessages();
            }, 100);
        });
    }


    $(document).on('submit', '#chat-form', function (e) {
        e.preventDefault();

        const form = $(this);
        const formData = form.serialize();

        $.post('{{ route('messages.send') }}', formData, function () {
            $('input[name="message"]').val('');
            fetchMessages(); // Load new message
            refreshConversations();  
        }).fail(function () {
            alert('Failed to send message');
        });
    });

    function refreshConversations() {
        $.get('{{ route("conversations.list") }}', function (data) {
            $('#conversation-list').html(data);
        });
    }
    setInterval(() => {
        refreshConversations();

        const receiverId = $('#chat-receiver-id').val();
        if (receiverId) {
            fetchMessages(); // Only if a chat is active
        }
    }, 5000);



    $(document).on('click', '.open-chat', function () {
        const receiverId = $(this).data('id');
        const eventId = $(this).data('event-id');
        loadMessages(receiverId, eventId);
    });

    // Polling every 5 seconds
    setInterval(() => {
        const receiverId = $('#chat-receiver-id').val();
        if (receiverId) fetchMessages();
    }, 5000);


</script>

@endpush

@if($loginType === 2)
    @include('client.footer')
@elseif($loginType === 3)
    @include('organizer.footer')
@elseif($loginType === 4)
    @include('vendor.footer')
@endif
