<header id="masthead" class="header ttm-header-style-classic-overlay">
    <!-- ttm-header-wrap -->
    <div class="ttm-header-wrap">
        <!-- ttm-stickable-header-w -->
        <div id="ttm-stickable-header-w" class="ttm-stickable-header-w clearfix">
            <div id="site-header-menu" class="site-header-menu">
                <div class="site-header-menu-inner ttm-stickable-header">
                    <div class="container">
                        <!-- site-branding -->
                        <div class="site-branding">
                            <a class="home-link" href="index.html" title="Planwey" rel="home">
                                <img id="logo-img" class="img-center" src="{{asset('images/logo-img.png')}}" alt="logo-img">
                            </a>
                        </div><!-- site-branding end -->
                        <div class="ttm-header-icons">
                            <div class="ttm-header-icon ttm-header-search-link">
                                <a href="#" class="open sclose"><i class="ti ti-search"></i></a>
                                <div class="ttm-search-overlay">
                                    <div class="container">
                                        <div class="row">
                                            <form method="get" class="ttm-site-searchform" action="#">
                                                <div class="w-search-form-h">
                                                    <div class="w-search-form-row">
                                                        <div class="w-search-input">
                                                            <input type="search" class="field searchform-s" name="s" placeholder="Type Word Then Enter...">
                                                            <button type="submit">
                                                                <i class="ti ti-search"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="ttm-search-close"><i class="fa fa-close"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="ttm-header-icon ttm-header-search-link">
                                <a href="#" class="open sclose"><i class="ti ti-user"> Login </i></a>
                                
                            </div> --}}
                        </div>
                        <!--site-navigation -->
                        <div id="site-navigation" class="site-navigation">
                            <div class="ttm-menu-toggle">
                                <input type="checkbox" id="menu-toggle-form" />
                                <label for="menu-toggle-form" class="ttm-menu-toggle-block">
                                    <span class="toggle-block toggle-blocks-1"></span>
                                    <span class="toggle-block toggle-blocks-2"></span>
                                    <span class="toggle-block toggle-blocks-3"></span>
                                </label>
                            </div>
                            <nav id="menu" class="menu">
                                <ul class="dropdown">
                                    <li><a href="/">Home</a></li>
                                    <li><a href="/events">Events</a></li>
                                    <li><a href="/organizers">Organizers</a></li>
                                    <li><a href="/vendors">Vendors</a></li>
                                    <li>
                                        <a href="#">More</a>
                                        <ul>
                                            <li><a href="about-us">About Us</a></li>
                                            <li><a href="contact-us">Contact Us</a></li>
                                            <li><a href="faqs">FAQ's</a></li>
                                            
                                            <!-- Show Logout only if user is logged in -->
                                            @if(Auth::check())
                                                <li><a href="/logout">Logout</a></li>
                                            @endif
                                        </ul>
                                    </li>
                            
                                    @php
                                        use Illuminate\Support\Facades\Auth;
                                    @endphp

                                    <!-- Show Dashboard only if user is logged in as Admin -->
                                    @if(Auth::check() && Auth::user()->login_type == 1)
                                        <li><a href="/administrator" class="active" style="color: var(--mulberry);">Dashboard</a></li>
                                    @endif

                                    <!-- Show Dashboard only if user is logged in as Client -->
                                    @if(Auth::check() && Auth::user()->login_type == 2)
                                        <li><a href="/client-dashboard" class="active" style="color: var(--mulberry);">Dashboard</a></li>
                                    @endif

                                    <!-- Show Dashboard only if user is logged in as Organizer -->
                                    @if(Auth::check() && Auth::user()->login_type == 3)
                                        <li><a href="/organizer-dashboard" class="active" style="color: var(--mulberry);">Dashboard</a></li>
                                    @endif
                                    
                                    <!-- Show Dashboard only if user is logged in as Vendor -->
                                    @if(Auth::check() && Auth::user()->login_type == 4)
                                        <li><a href="/vendor-dashboard" class="active" style="color: var(--mulberry);">Dashboard</a></li>
                                    @endif

                                    <!-- Show Login only if user is not logged in -->
                                    @if(!Auth::check())
                                        <li><a href="/login">Login</a></li>
                                    @endif

                                </ul>
                            </nav>
                            
                        </div><!-- site-navigation end-->
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <!--ttm-header-wrap end -->
    <!--rev-slider -->
    
    <!--rev-slider end-->
</header>
<!--header end-->

<!--site-main start-->