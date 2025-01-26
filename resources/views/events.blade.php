@include('include.header',['page_title' => 'Events | Eventiary'])

    @include('include.events.title')
    <!-- site-main start -->
    <div class="site-main">

    @include('include.events.list')

    </div>
    <!-- site-main end -->

@include('include.footer')