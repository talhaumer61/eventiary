@include('organizer.header',['page_title' => 'My Team | Eventiary'])
@if ($action == "add")
    @include('organizer.include.team.add')
@elseif ($action == "edit")
    @include('organizer.include.team.edit')
@else
    @include('organizer.include.team.list')
@endif
@include('organizer.footer')
