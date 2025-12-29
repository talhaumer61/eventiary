<div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div>
        <h1 class="page-title fw-medium fs-18 mb-2">Admin Dashboard</h1>
        <div class="">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Header Close -->

<!-- Start::row-1 -->
<div class="row">
    <div class="col-xl-12">
        <div class="row">

            <!-- Total Users -->
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div>
                                <div class="fs-15 mb-3">Total Users</div>
                            </div>
                            <div>
                                <span class="avatar avatar-md bg-outline-primary">
                                    <i class="ri-map-pin-user-line fs-18"></i>
                                </span>
                            </div>
                        </div>
                        <div class="fs-25 fw-bold">{{ $totalUsers }}</div>
                    </div>
                </div>
            </div>

            <!-- Total Organizers -->
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div>
                                <div class="fs-15 mb-3">Organizers</div>
                            </div>
                            <div>
                                <span class="avatar avatar-md bg-outline-success">
                                    <i class="ri-user-star-line fs-18"></i>
                                </span>
                            </div>
                        </div>
                        <div class="fs-25 fw-bold">{{ $totalOrganizers }}</div>
                    </div>
                </div>
            </div>

            <!-- Total Vendors -->
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div>
                                <div class="fs-15 mb-3">Vendors</div>
                            </div>
                            <div>
                                <span class="avatar avatar-md bg-outline-info">
                                    <i class="ri-store-2-line fs-18"></i>
                                </span>
                            </div>
                        </div>
                        <div class="fs-25 fw-bold">{{ $totalVendors }}</div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row mt-3">

            <!-- Total Jobs -->
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div>
                                <div class="fs-15 mb-3">Jobs Posted</div>
                            </div>
                            <div>
                                <span class="avatar avatar-md bg-outline-warning">
                                    <i class="ri-briefcase-line fs-18"></i>
                                </span>
                            </div>
                        </div>
                        <div class="fs-25 fw-bold">{{ $totalJobs }}</div>
                    </div>
                </div>
            </div>

            <!-- Events -->
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div>
                                <div class="fs-15 mb-3">Events</div>
                            </div>
                            <div>
                                <span class="avatar avatar-md bg-outline-secondary">
                                    <i class="ri-calendar-event-line fs-18"></i>
                                </span>
                            </div>
                        </div>
                        <div class="fs-25 fw-bold">{{ $totalEvents }}</div>
                    </div>
                </div>
            </div>

            <!-- Payments -->
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div>
                                <div class="fs-15 mb-3">Payments</div>
                            </div>
                            <div>
                                <span class="avatar avatar-md bg-outline-success">
                                    <i class="ri-money-dollar-circle-line fs-18"></i>
                                </span>
                            </div>
                        </div>
                        <div class="fs-25 fw-bold">{{ $totalPayments }}</div>
                    </div>
                </div>
            </div>

        </div>

        {{-- <div class="row mt-3">

            <!-- Reviews -->
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div>
                                <div class="fs-15 mb-3">Reviews</div>
                            </div>
                            <div>
                                <span class="avatar avatar-md bg-outline-danger">
                                    <i class="ri-star-line fs-18"></i>
                                </span>
                            </div>
                        </div>
                        <div class="fs-25 fw-bold">{{ $totalReviews }}</div>
                    </div>
                </div>
            </div>

        </div> --}}

    </div>
</div>
