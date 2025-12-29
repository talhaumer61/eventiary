@include('client.header', ['page_title' => 'My Cards | Eventiary'])

@if(isset($eventId))
    @include('client.include.my_cards.create')
@else
    @include('client.include.my_cards.list')
@endif

@include('client.footer')
