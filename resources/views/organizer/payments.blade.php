@include('organizer.header',['page_title' => 'My Payments | Eventiary'])
@if ($type = "sent")
    @include('organizer.include.payments.sent')
@else
    @include('organizer.include.payments.received')
@endif
@include('organizer.footer')
