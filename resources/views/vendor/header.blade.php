@include('vendor.header_links')

<header class="app-header">

  <!-- Start::main-header-container -->
  <div class="main-header-container container-fluid">

      <!-- Start::header-content-left -->
      <div class="header-content-left">

          <!-- Start::header-element -->
          <div class="header-element">
              <div class="horizontal-logo">
                  <a href="#" class="header-logo">
                      <img src="images/logo-img.png" alt="logo" class="desktop-logo">
                      <img src="images/favicon.png" alt="logo" class="toggle-logo">
                      <img src="images/logo-img.png" alt="logo" class="desktop-dark">
                      <img src="images/favicon.png" alt="logo" class="toggle-dark">
                  </a>
              </div>
          </div>
          <!-- End::header-element -->

          <!-- Start::header-element -->
          <div class="header-element mx-lg-0 mx-2">
              <a aria-label="Hide Sidebar" class="sidemenu-toggle header-link animated-arrow hor-toggle horizontal-navtoggle" data-bs-toggle="sidebar" href="javascript:void(0);"><span></span></a>
          </div>
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
          <li class="header-element notifications-dropdown d-xl-block d-none">

            <a href="javascript:void(0);" 
            class="header-link dropdown-toggle" 
            data-bs-toggle="dropdown" 
            data-bs-auto-close="outside">

                <i class="bi bi-bell header-link-icon"></i>

                @if($global_unread_count > 0)
                    <span class="header-icon-pulse bg-secondary rounded pulse pulse-secondary"></span>
                @endif
            </a>

            <div class="main-header-dropdown dropdown-menu dropdown-menu-end">

                <div class="p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="mb-0 fs-16">Notifications</p>
                        <span class="badge bg-secondary-transparent">
                            {{ $global_unread_count }} Unread
                        </span>
                    </div>
                </div>

                <div class="dropdown-divider"></div>

                <ul class="list-unstyled mb-0" id="header-notification-scroll">
                    @forelse($global_notifications as $note)

                        <li class="dropdown-item">
                            <div class="d-flex align-items-center">

                                <div class="pe-2 lh-1">
                                    <span class="avatar avatar-rounded bg-secondary-transparent">
                                        <i class="bi bi-bell"></i>
                                    </span>
                                </div>

                                <div class="flex-grow-1 d-flex align-items-center justify-content-between">

                                    <div>
                                        <p class="mb-0 fw-medium">
                                            <a href="{{ $note->link ?? '#' }}">
                                                {{ $note->title }}
                                            </a>
                                        </p>

                                        <span class="text-muted fw-normal fs-12 header-notification-text">
                                            {{ $note->message }}
                                        </span>
                                    </div>

                                    <div>
                                        <small class="text-muted fs-10">
                                            {{ $note->created_at->diffForHumans() }}
                                        </small>
                                    </div>

                                </div>

                            </div>
                        </li>

                    @empty

                        <li class="p-3 text-center text-muted">
                            <i class="ri-notification-off-line fs-2"></i>
                            <div>No New Notifications</div>
                        </li>

                    @endforelse
                </ul>

                <div class="p-3 text-center border-top">
                    <a href="/notifications" class="link-primary text-decoration-underline">View All</a>
                </div>

            </div>
        </li>

            @php
                use Illuminate\Support\Facades\Auth;
            @endphp
          <li class="header-element">
              <!-- Start::header-link|dropdown-toggle -->
              <a href="javascript:void(0);" class="header-link dropdown-toggle" id="mainHeaderProfile" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                  <div class="d-flex align-items-center">
                      <div class="me-sm-2 me-0">
                          <img src="{{ Auth::user()->photo }}" alt="img" class="avatar avatar-sm avatar-rounded">
                      </div>
                      <div class="d-xl-block d-none lh-1">
                          <span class="fw-medium lh-1">{{ Auth::user()->name }}</span>
                      </div>
                  </div>
              </a>
              <!-- End::header-link|dropdown-toggle -->
              <ul class="main-header-dropdown dropdown-menu pt-0 overflow-hidden header-profile-dropdown dropdown-menu-end" aria-labelledby="mainHeaderProfile">
                  <li><a class="dropdown-item d-flex align-items-center" href="/vendor/profile"><i class="bi bi-person fs-18 me-2 op-7"></i>Profile</a></li>
                  {{-- <li><a class="dropdown-item d-flex align-items-center" href="#"><i class="bi bi-gear fs-16 me-2 op-7"></i>Settings</a></li> --}}
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

@include('vendor.sidebar')
@include('vendor.sessionMsg')