@include('include.header',['page_title' => ''.$organizer->name.' | Eventiary'])

    @include('include.organizer_profile.title')
    <!-- site-main start -->
    <div class="site-main">

    @include('include.organizer_profile.detail')

    </div>
    <!-- site-main end -->

@include('include.footer')