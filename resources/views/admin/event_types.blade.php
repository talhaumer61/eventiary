@include('admin.header',['page_title' => 'Event Types | Eventiary'])
    @if ($action == "add")
        @include('admin.include.event_types.add')
    @elseif ($action == "edit" && isset($eventType))
        @include('admin.include.event_types.edit', ['eventType' => $eventType])
    @else
        @include('admin.include.event_types.list')
    @endif
@include('admin.footer')
