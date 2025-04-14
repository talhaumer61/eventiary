@include('client.header', ['page_title' => 'My Events | Eventiary'])

@if(isset($event))
    @include('client.include.my_events.edit')
@else
    @include('client.include.my_events.list')
@endif

@include('client.footer')
