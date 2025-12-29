@include('client.header', ['page_title' => 'My Jobs | Eventiary'])

@if($action == 'create' )
    @include('client.include.my_jobs.create')
@elseif($action == 'manage' )
    @include('client.include.my_jobs.manage')
@elseif($action == 'show' )
    @include('client.include.my_jobs.show')
@else
    @include('client.include.my_jobs.list')
@endif

@include('client.footer')
