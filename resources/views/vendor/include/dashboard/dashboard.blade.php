<div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item active" aria-current="page">Home</li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">Vendor Dashboard</a></li>
            </ol>
        </nav>
    </div>
</div>

<!-- Welcome Section -->
<div class="d-flex justify-content-center align-items-center mb-1" style="height: 7vh;">
    <h1 class="fw-bold text-center" style="font-size: 30px;">
        Welcome to Vendor Dashboard
    </h1>
</div>

<!-- Stats Section -->
<div class="row">
    <!-- Vendor Assignments -->
    <div class="col-xl-6 col-md-6">
        <div class="card custom-card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <h5 class="fw-medium">Bookings</h5>
                    <span class="avatar avatar-md bg-success-transparent">
                        <i class="ri-task-line fs-18 text-success"></i>
                    </span>
                </div>
                <h2 class="fw-bold">{{ $assignments }}</h2>
            </div>
        </div>
    </div>

    <!-- Reviews -->
    <div class="col-xl-6 col-md-6">
        <div class="card custom-card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <h5 class="fw-medium">Reviews</h5>
                    <span class="avatar avatar-md bg-warning-transparent">
                        <i class="ri-chat-1-line fs-18 text-warning"></i>
                    </span>
                </div>
                <h2 class="fw-bold">{{ $reviews }}</h2>
            </div>
        </div>
    </div>

    <!-- Average Rating -->
    <div class="col-xl-6 col-md-6">
        <div class="card custom-card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <h5 class="fw-medium">Average Rating</h5>
                    <span class="avatar avatar-md bg-info-transparent">
                        <i class="ri-star-smile-line fs-18 text-info"></i>
                    </span>
                </div>

                <div class="d-flex align-items-center">
                    <h2 class="fw-bold mb-0">{{ $avgRating }}</h2>

                    <span class="text-warning ms-2">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="{{ $i <= floor($avgRating) ? 'fa fa-star text-warning' : 'fa fa-star-o text-muted' }}"></i>
                        @endfor
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Payments Received -->
    <div class="col-xl-6 col-md-6 mt-3">
        <div class="card custom-card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <h5 class="fw-medium">Total Payments Received</h5>
                    <span class="avatar avatar-md bg-danger-transparent">
                        <i class="ri-money-dollar-circle-line fs-18 text-danger"></i>
                    </span>
                </div>
                <h2 class="fw-bold">Rs {{ number_format($totalPayments, 0) }}</h2>
            </div>
        </div>
    </div>

</div>
