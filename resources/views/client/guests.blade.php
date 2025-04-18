@include('client.header',['page_title' => 'Guests | Eventiary'])
    @if ($action == "edit" && isset($guest))
        @include('client.include.guests.edit')
    @elseif($action== "add")
        @include('client.include.guests.add')
    @else
        @include('client.include.guests.list')
    @endif
@include('client.footer')
