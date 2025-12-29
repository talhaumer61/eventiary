@include('organizer.header',['page_title' => 'My Portfolio | Eventiary'])
@if ($action == "add")
    @include('organizer.include.portfolio.add')
@elseif ($action == "edit")
    @include('organizer.include.portfolio.edit')
@else
    @include('organizer.include.portfolio.list')
@endif
@include('organizer.footer')
