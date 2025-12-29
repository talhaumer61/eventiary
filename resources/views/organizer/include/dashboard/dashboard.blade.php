<div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div>
        <div class="">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item active" aria-current="page">Home</li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Organizer Dashboard</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- Welcome Section -->
<div class="d-flex justify-content-center align-items-center mb-1" style="height: 7vh;">
    <h1 class="fw-bold text-center" style="font-size: 30px;">
        Welcome to Organizer Dashboard
    </h1>
</div>

<!-- Stats Cards -->
<div class="row">
    <!-- Assignments -->
    <div class="col-xl-6 col-md-6">
        <div class="card custom-card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <h5 class="fw-medium">Bookings</h5>
                    <span class="avatar avatar-md bg-primary-transparent">
                        <i class="ri-briefcase-line fs-18 text-primary"></i>
                    </span>
                </div>
                <h2 class="fw-bold">{{ $assignments }}</h2>
            </div>
        </div>
    </div>

    <!-- Payments -->
    <div class="col-xl-6 col-md-6">
        <div class="card custom-card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <h5 class="fw-medium">Payments</h5>
                    <span class="avatar avatar-md bg-warning-transparent">
                        <i class="ri-bank-card-line fs-18 text-warning"></i>
                    </span>
                </div>
                <h2 class="fw-bold">{{ $payments }}</h2>
            </div>
        </div>
    </div>

    <!-- Portfolio Items -->
    <div class="col-xl-6 col-md-6">
        <div class="card custom-card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <h5 class="fw-medium">Portfolio Items</h5>
                    <span class="avatar avatar-md bg-info-transparent">
                        <i class="ri-image-line fs-18 text-info"></i>
                    </span>
                </div>
                <h2 class="fw-bold">{{ $portfolio }}</h2>
            </div>
        </div>
    </div>

    <!-- Team Members -->
    <div class="col-xl-6 col-md-6 mt-3">
        <div class="card custom-card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <h5 class="fw-medium">Team Members</h5>
                    <span class="avatar avatar-md bg-danger-transparent">
                        <i class="ri-group-line fs-18 text-danger"></i>
                    </span>
                </div>
                <h2 class="fw-bold">{{ $team }}</h2>
            </div>
        </div>
    </div>

</div>
