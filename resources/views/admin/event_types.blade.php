@include('admin.header',['page_title' => 'Event Types | Eventiary'])
    @if ($action == "add")
        @include('admin.include.event_types.add')
    @else
        @include('admin.include.event_types.list')
    @endif
@include('admin.footer')
