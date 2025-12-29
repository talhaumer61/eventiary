@include('include.header', ['page_title' => 'Listed Jobs'])

    @include('include.jobs.title')
    <div class="site-main">
        @include('include.jobs.list')
    </div>

@include('include.footer')
