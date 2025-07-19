@include('vendor.header',['page_title' => 'My Services | Eventiary'])
    @if ($action == "edit" && isset($editService))
        @include('vendor.include.services.edit')
    @elseif($action== "add")
        @include('vendor.include.services.add')
    @else
        @include('vendor.include.services.list')
    @endif
@include('vendor.footer')
