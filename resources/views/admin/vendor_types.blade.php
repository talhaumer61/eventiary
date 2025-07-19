@include('admin.header',['page_title' => 'Vendor Types | Eventiary'])
    @if ($action == "add")
        @include('admin.include.vendor_types.add')
    @elseif ($action == "edit" && isset($vendorType))
        @include('admin.include.vendor_types.edit', ['vendorType' => $vendorType])
    @else
        @include('admin.include.vendor_types.list')
    @endif
@include('admin.footer')
