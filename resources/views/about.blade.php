@include('include.header', ['page_title' => 'About Us | Eventiary'])

    @include('include.about.title')
    <div class="site-main">
        @include('include.about.intro')
        @include('include.about.wwd')
        @include('include.about.counters')
        @include('include.about.process')
    </div>


@include('include.footer')
