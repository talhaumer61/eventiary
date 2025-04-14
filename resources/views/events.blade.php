@include('include.header', ['page_title' => $page_title])

@if($is_detail)
    {{-- Event Detail View --}}
    @include('include.events.event_title')
    <div class="site-main">
        @include('include.events.detail')
    </div>
@else
    {{-- Event List View --}}
    @include('include.events.title')
    <div class="site-main">
        @include('include.events.list')
    </div>
@endif

@include('include.footer')
