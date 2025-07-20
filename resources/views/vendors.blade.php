@include('include.header', ['page_title' => 'Vendors | Eventiary'])

@if($action === 'profile' && $selectedVendor)
    @include('include.vendors.vendor_title', ['vendor' => $selectedVendor])
    <div class="site-main">
        @include('include.vendors.profile', ['vendor' => $selectedVendor, 'services' => $vendorServices])
    </div>
@else
    @include('include.vendors.title')
    <div class="site-main">
        @include('include.vendors.list', ['vendors' => $vendors])
    </div>
@endif

@include('include.footer')
