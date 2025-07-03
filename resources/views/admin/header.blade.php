@include('admin.header_links')

<header class="app-header">

  <!-- Start::main-header-container -->
  <div class="main-header-container container-fluid admin-sidebar">

      <!-- Start::header-content-left -->
      <div class="header-content-left">

          <!-- Start::header-element -->
          <div class="header-element">
              <div class="horizontal-logo">
                  <a href="/administrator" class="header-logo">
                      <img src="{{asset('images/logo-img.png')}}" alt="logo" class="desktop-logo">
                      <img src="{{asset('images/favicon.png')}}" alt="logo" class="toggle-logo">
                      <img src="{{asset('images/logo-img.png')}}" alt="logo" class="desktop-dark">
                      <img src="{{asset('images/favicon.png')}}" alt="logo" class="toggle-dark">
                  </a>
              </div>
          </div>
          <!-- End::header-element -->

          <!-- Start::header-element -->
          <div class="header-element mx-lg-0 mx-2">
              <a aria-label="Hide Sidebar" class="sidemenu-toggle header-link animated-arrow hor-toggle horizontal-navtoggle" data-bs-toggle="sidebar" href="javascript:void(0);"><span></span></a>
          </div>
          <!-- End::header-element -->

          <!-- Start::header-element -->
          <div class="header-element header-search d-md-block d-none">
              <!-- Start::header-link -->
              <input type="text" class="header-search-bar form-control border-0 bg-body" placeholder="Search for Results...">
              <a href="javascript:void(0);" class="header-search-icon border-0">
                  <i class="bi bi-search"></i>
              </a>
              <!-- End::header-link -->
          </div>
          <!-- End::header-element -->

          <!-- Start::header-element --> 
          {{-- <div class="header-element ms-3 d-lg-block d-none my-auto">
              <!-- Start::dashboards list -->
              <div class="dropdown my-auto">
                  <a href="javascript:void(0);" class="btn bg-body header-dashboards-button text-start d-flex align-items-center justify-content-between" data-bs-toggle="dropdown" aria-expanded="false">
                  </a> 
                  <ul class="dropdown-menu dashboard-dropdown" role="menu">
                      <li><a class="dropdown-item dashboards-dropdown-item" href="index.html">Sales Dashboard</a></li>
                      <li><a class="dropdown-item dashboards-dropdown-item" href="index-1.html">Analytics Dashboard</a></li>
                      <li><a class="dropdown-item dashboards-dropdown-item" href="index-2.html">Ecommerce Dashboard</a></li>
                      <li><a class="dropdown-item dashboards-dropdown-item" href="index-3.html">CRM Dashboard</a></li>
                      <li><a class="dropdown-item dashboards-dropdown-item" href="index-4.html">HRM Dashboard</a></li>
                      <li><a class="dropdown-item dashboards-dropdown-item" href="index-5.html">NFT Dashboard</a></li>
                      <li><a class="dropdown-item dashboards-dropdown-item" href="index-6.html">Crypto Dashboard</a></li>
                      <li><a class="dropdown-item dashboards-dropdown-item" href="index-7.html">Jobs Dashboard</a></li>
                      <li><a class="dropdown-item dashboards-dropdown-item" href="index-8.html">Projects Dashboard</a></li>
                      <li><a class="dropdown-item dashboards-dropdown-item" href="index-9.html">Courses Dashboard</a></li>
                      <li><a class="dropdown-item dashboards-dropdown-item" href="index-10.html">Stocks Dashboard</a></li>
                      <li><a class="dropdown-item dashboards-dropdown-item" href="index-11.html">Personal Dashboard</a></li>
                      <li><a class="dropdown-item dashboards-dropdown-item" href="index-12.html">Customer Dashboard</a></li>
                  </ul>
              </div>
              <!-- End::dashboards list -->
          </div> --}}
          <!-- End::header-element -->

      </div>
      <!-- End::header-content-left -->

      <!-- Start::header-content-right -->
      <ul class="header-content-right">

          <!-- Start::header-element -->
          <li class="header-element d-md-none d-block">
              <a href="javascript:void(0);" class="header-link" data-bs-toggle="modal" data-bs-target="#header-responsive-search">
                  <!-- Start::header-link-icon -->
                  <i class="bi bi-search header-link-icon"></i>
                  <!-- End::header-link-icon -->
              </a>  
          </li>
          <!-- End::header-element -->

          <!-- Start::header-element -->
          {{-- <li class="header-element country-selector">
              <!-- Start::header-link|dropdown-toggle -->
              <a href="javascript:void(0);" class="header-link dropdown-toggle" data-bs-auto-close="outside" data-bs-toggle="dropdown">
                  <img src="dashboard/images/flags/us_flag.jpg" alt="img" class="rounded-circle">
              </a>
              <!-- End::header-link|dropdown-toggle -->
              <ul class="main-header-dropdown dropdown-menu dropdown-menu-end" data-popper-placement="none">
                  <li>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);">
                          <span class="avatar avatar-xs lh-1 me-2">
                              <img src="dashboard/images/flags/us_flag.jpg" alt="img">
                          </span>
                          English
                      </a>
                  </li>
                  <li>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);">
                          <span class="avatar avatar-xs lh-1 me-2">
                              <img src="dashboard/images/flags/spain_flag.jpg" alt="img" >
                          </span>
                          Spanish
                      </a>
                  </li>
                  <li>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);">
                          <span class="avatar avatar-xs lh-1 me-2">
                              <img src="dashboard/images/flags/french_flag.jpg" alt="img" >
                          </span>
                          French
                      </a>
                  </li>
                  <li>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);">
                          <span class="avatar avatar-xs lh-1 me-2">
                              <img src="dashboard/images/flags/germany_flag.jpg" alt="img" >
                          </span>
                          German
                      </a>
                  </li>
                  <li>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);">
                          <span class="avatar avatar-xs lh-1 me-2">
                              <img src="dashboard/images/flags/italy_flag.jpg" alt="img" >
                          </span>
                          Italian
                      </a>
                  </li>
                  <li>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);">
                          <span class="avatar avatar-xs lh-1 me-2">
                              <img src="dashboard/images/flags/russia_flag.jpg" alt="img" >
                          </span>
                          Russian
                      </a>
                  </li>
              </ul>
          </li> --}}
          

          
          {{-- <li class="header-element header-theme-mode">
              <!-- Start::header-link|layout-setting -->
              <a href="javascript:void(0);" class="header-link layout-setting">
                  <span class="light-layout">
                      <!-- Start::header-link-icon -->
                      <i class="bi bi-moon header-link-icon"></i>
                      <!-- End::header-link-icon -->
                  </span>
                  <span class="dark-layout">
                      <!-- Start::header-link-icon -->
                      <i class="bi bi-brightness-high header-link-icon"></i>
                      <!-- End::header-link-icon -->
                  </span>
              </a>
              <!-- End::header-link|layout-setting -->
          </li> --}}
          

          
          {{-- <li class="header-element cart-dropdown">
            <a type="button" class="btn btn-primary btn-wave" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-primary"
                data-bs-placement="top" title="Primary Tooltip">
                Primary Tooltip
            </a>
          </li> --}}
          

          
          <li class="header-element notifications-dropdown d-xl-block d-none">
              <!-- Start::header-link|dropdown-toggle -->
              <a href="javascript:void(0);" class="header-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside" id="messageDropdown" aria-expanded="false">
                  <i class="bi bi-bell header-link-icon"></i>
                  <span class="header-icon-pulse bg-secondary rounded pulse pulse-secondary"></span>
              </a>
              <!-- End::header-link|dropdown-toggle -->
              <!-- Start::main-header-dropdown -->
              <div class="main-header-dropdown dropdown-menu dropdown-menu-end" data-popper-placement="none">
                  <div class="p-3">
                      <div class="d-flex align-items-center justify-content-between">
                          <p class="mb-0 fs-16">Notifications</p>
                          <span class="badge bg-secondary-transparent" id="notifiation-data">5 Unread</span>
                      </div>
                  </div>
                  <div class="dropdown-divider"></div>
                  <ul class="list-unstyled mb-0" id="header-notification-scroll">
                      <li class="dropdown-item">
                          <div class="d-flex align-items-center">
                              <div class="pe-2 lh-1">
                                  <span class="avatar avatar-rounded">
                                      <img src="dashboard/images/faces/11.jpg" alt="">
                                  </span>
                              </div>
                              <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                  <div>
                                      <p class="mb-0 fw-medium"><a href="notifications.html">John Doe</a></p>
                                      <span class="text-muted fw-normal fs-12 header-notification-text">Hey there! What's up?</span>
                                  </div>
                                  <div>
                                      <a href="javascript:void(0);" class="min-w-fit-content text-muted me-1 dropdown-item-close1"><i class="ti ti-x fs-16"></i></a>
                                  </div>
                              </div>
                          </div>
                      </li>
                      <li class="dropdown-item">
                          <div class="d-flex align-items-center">
                              <div class="pe-2 lh-1">
                                  <span class="avatar bg-secondary-transparent avatar-rounded">
                                      <img src="dashboard/images/faces/21.jpg" alt="">
                                  </span>
                              </div>
                              <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                  <div>
                                      <p class="mb-0 fw-medium"><a href="notifications.html">Customer Support</a></p>
                                      <span class="text-muted fw-normal fs-12 header-notification-text">Great job on resolving the issue! Thank you!</span>
                                  </div>
                                  <div>
                                      <a href="javascript:void(0);" class="min-w-fit-content text-muted me-1 dropdown-item-close1"><i class="ti ti-x"></i></a>
                                  </div>
                              </div>
                          </div>
                      </li>
                      <li class="dropdown-item">
                          <div class="d-flex align-items-center">
                              <div class="pe-2 lh-1">
                                  <span class="avatar bg-pink-transparent avatar-rounded">
                                      <img src="dashboard/images/faces/20.jpg" alt="">
                                  </span>
                              </div>
                              <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                  <div>
                                      <p class="mb-0 fw-medium"><a href="notifications.html">Digital Marketing Trends</a></p>
                                      <span class="text-muted fw-normal fs-12 header-notification-text">Next Thursday at 2:30 PM</span>
                                  </div>
                                  <div>
                                      <a href="javascript:void(0);" class="min-w-fit-content text-muted me-1 dropdown-item-close1"><i class="ti ti-x"></i></a>
                                  </div>
                              </div>
                          </div>
                      </li>
                      <li class="dropdown-item">
                          <div class="d-flex align-items-center">
                              <div class="pe-2 lh-1">
                                  <span class="avatar bg-danger-transparent avatar-rounded"><i class="ti ti-circle-check fs-18"></i></span>
                              </div>
                              <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                  <div>
                                      <p class="mb-0 fw-medium"><a href="notifications.html">Amount: $50.00 paid for the order</a></p>
                                      <span class="text-muted fw-normal fs-12 header-notification-text">Transaction ID: 123456789</span>
                                  </div>
                                  <div>
                                      <a href="javascript:void(0);" class="min-w-fit-content text-muted me-1 dropdown-item-close1"><i class="ti ti-x"></i></a>
                                  </div>
                              </div>
                          </div>
                      </li>
                      <li class="dropdown-item">
                          <div class="d-flex align-items-center">
                              <div class="pe-2 lh-1">
                                  <span class="avatar bg-success-transparent avatar-rounded">
                                      <img src="dashboard/images/faces/6.jpg" alt="">
                                  </span>
                              </div>
                              <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                  <div>
                                      <p class="mb-0 fw-medium"><a href="notifications.html">Samantha</a></p>
                                      <span class="text-muted fw-normal fs-12 header-notification-text">Would you like to connect?</span>
                                  </div>
                                  <div>
                                      <a href="javascript:void(0);" class="min-w-fit-content text-muted me-1 dropdown-item-close1"><i class="ti ti-x"></i></a>
                                  </div>
                              </div>
                          </div>
                      </li>
                  </ul>
                  <div class="p-3 empty-header-item1 border-top">
                      <div class="text-center">
                          <a href="notifications.html" class="link-primary text-decoration-underline">View All</a>
                      </div>
                  </div>
                  <div class="p-5 empty-item1 d-none">
                      <div class="text-center">
                          <span class="avatar avatar-xl avatar-rounded bg-secondary-transparent">
                              <i class="ri-notification-off-line fs-2"></i>
                          </span>
                          <h6 class="fw-medium mt-3">No New Notifications</h6>
                      </div>
                  </div>
              </div>
              <!-- End::main-header-dropdown -->
          </li>
          

          
          {{-- <li class="header-element header-fullscreen">
              <!-- Start::header-link -->
              <a onclick="openFullscreen();" href="javascript:void(0);" class="header-link">
                  <i class="bi bi-fullscreen full-screen-open header-link-icon"></i>
                  <i class="bi bi-fullscreen-exit full-screen-close header-link-icon d-none"></i>
              </a>
              <!-- End::header-link -->
          </li> --}}
          

          
          <li class="header-element">
              <!-- Start::header-link|dropdown-toggle -->
              <a href="javascript:void(0);" class="header-link dropdown-toggle" id="mainHeaderProfile" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                  <div class="d-flex align-items-center">
                      <div class="me-sm-2 me-0">
                          <img src="{{session('user')->photo}}" alt="img" class="avatar avatar-sm avatar-rounded">
                      </div>
                      <div class="d-xl-block d-none lh-1">
                          <span class="fw-medium lh-1">{{session('user')->name}}</span>
                      </div>
                  </div>
              </a>
              <!-- End::header-link|dropdown-toggle -->
              <ul class="main-header-dropdown dropdown-menu pt-0 overflow-hidden header-profile-dropdown dropdown-menu-end" aria-labelledby="mainHeaderProfile">
                  <li><a class="dropdown-item d-flex align-items-center" href="/admin-profile"><i class="bi bi-person fs-18 me-2 op-7"></i>Profile</a></li>
                  <li><a class="dropdown-item d-flex align-items-center" href="#"><i class="bi bi-gear fs-16 me-2 op-7"></i>Settings</a></li>
                  <li><a class="dropdown-item d-flex align-items-center" href="/logout"><i class="bi bi-box-arrow-right fs-18 me-2 op-7"></i>Log Out</a></li>
              </ul>
          </li>  
          

          
          {{-- <li class="header-element">
              <!-- Start::header-link|switcher-icon -->
              <a href="javascript:void(0);" class="header-link switcher-icon" data-bs-toggle="offcanvas" data-bs-target="#switcher-canvas">
                  <i class="bi bi-gear header-link-icon border-0"></i>
              </a>
              <!-- End::header-link|switcher-icon -->
          </li> --}}
          

      </ul>
      <!-- End::header-content-right -->

  </div>
  <!-- End::main-header-container -->

</header>

@include('admin.sidebar')