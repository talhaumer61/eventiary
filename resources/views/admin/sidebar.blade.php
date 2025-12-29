<aside class="app-sidebar sticky" id="sidebar">

    <!-- Start::main-sidebar-header -->
    <div class="main-sidebar-header admin-sidebar">
        <a href="/administrator" class="header-logo">
            <img src="{{asset('images/logo-img.png')}}" alt="logo" class="desktop-logo">
            <img src="{{asset('images/favicon.png')}}" alt="logo" class="toggle-dark">
            <img src="{{asset('images/logo-img.png')}}" alt="logo" class="desktop-dark">
            <img src="{{asset('images/favicon.png')}}" alt="logo" class="toggle-logo">
        </a>
    </div>
    <!-- End::main-sidebar-header -->

    <!-- Start::main-sidebar -->
    <div class="main-sidebar admin-sidebar" id="sidebar-scroll">

        <!-- Start::nav -->
        <nav class="main-menu-container nav nav-pills flex-column sub-open">
            <div class="slide-left" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path> </svg>
            </div>
            <ul class="main-menu">

                <li class="slide">
                    <a href="/" class="side-menu__item">
                        <i class="bi bi-globe2 side-menu__icon"></i>
                        <span class="side-menu__label">Back to Website</span>
                    </a>
                </li>
                <li class="slide">
                    <a href="/administrator" class="side-menu__item">
                        <i class="bi bi-house side-menu__icon"></i>
                        <span class="side-menu__label">Dashboard</span>
                    </a>
                </li>
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="bi bi-ticket-detailed side-menu__icon"></i>
                        <span class="side-menu__label">Events</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1" style="position: relative; left: 0px; top: 0px; margin: 0px; transform: translate3d(128px, 270px, 0px); display: none; box-sizing: border-box;" data-popper-placement="bottom">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Types</a>
                        </li>
                        <li class="slide">
                            <a href="/events-list" class="side-menu__item">List</a>
                        </li>
                        <li class="slide">
                            <a href="/event-types" class="side-menu__item">Types</a>
                        </li>
                    </ul>
                </li>
                <li class="slide">
                    <a href="/users" class="side-menu__item">
                        <i class="bi bi-people-fill side-menu__icon"></i>
                        <span class="side-menu__label">Users</span>
                    </a>
                </li>
                <li class="slide">
                    <a href="/organizers-list" class="side-menu__item">
                        <i class="bi bi-person-workspace side-menu__icon"></i>
                        <span class="side-menu__label">Organizers</span>
                    </a>
                </li>
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="bi bi-shop-window side-menu__icon"></i>
                        <span class="side-menu__label">Vendors</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1" style="position: relative; left: 0px; top: 0px; margin: 0px; transform: translate3d(128px, 270px, 0px); display: none; box-sizing: border-box;" data-popper-placement="bottom">
                        <li class="slide">
                            <a href="/vendors-list" class="side-menu__item">List</a>
                        </li>
                        <li class="slide">
                            <a href="/vendor-types" class="side-menu__item">Types</a>
                        </li>
                    </ul>
                </li>
                <li class="slide">
                    <a href="/transactions" class="side-menu__item">
                        <i class="bi bi-cash side-menu__icon"></i>
                        <span class="side-menu__label">Transactions</span>
                    </a>
                </li>
                <li class="slide">
                    <a href="all-jobs" class="side-menu__item">
                        <i class="bi bi-diagram-3 side-menu__icon"></i>
                        <span class="side-menu__label">Jobs</span>
                    </a>
                </li>

            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path> </svg></div>
        </nav>
        <!-- End::nav -->

    </div>
    <!-- End::main-sidebar -->

</aside>
<!-- End::app-sidebar -->

<!-- Start::app-content -->
<div class="main-content app-content">
    <div class="container-fluid">