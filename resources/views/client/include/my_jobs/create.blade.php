<!-- Page Header -->
<div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div>
        <h1 class="page-title fw-medium fs-18 mb-2">Create Job</h1>
        <div class="">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Post a Jobs</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Header Close -->

<!-- Start::row-1 -->
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-body add-products p-0">
                <form action="{{ route('jobs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="p-4">
                        <div class="row gx-5">
                            <div class="col-xxl-6 col-xl-12 col-lg-12 col-md-6">
                                <div class="card custom-card shadow-none mb-0 border-0">
                                    <div class="card-body p-0">
                                        <div class="row gy-3">

                                            <!-- Event Selection -->
                                            <div class="col-xl-12">
                                                <label for="event-select" class="form-label">Event</label>
                                                <select class="form-control" id="event-select" name="event_id" required>
                                                    <option value="">Select Event</option>
                                                    @foreach($events as $event)
                                                        <option value="{{ $event->event_id }}">{{ $event->event_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Job Title -->
                                            <div class="col-xl-12">
                                                <label for="job-title" class="form-label">Title</label>
                                                <input type="text" class="form-control" id="job-title" name="title" placeholder="Enter job title" required>
                                            </div>

                                            <!-- Job Description -->
                                            <div class="col-xl-12">
                                                <label for="job-description" class="form-label">Description</label>
                                                <textarea class="form-control" id="job-description" rows="5" name="description" placeholder="Enter job description" required></textarea>
                                            </div>

                                            <!-- Budget -->
                                            {{-- <div class="col-xl-6">
                                                <label for="job-budget" class="form-label">Budget</label>
                                                <input type="number" class="form-control" id="job-budget" name="budget" step="0.01" placeholder="Enter budget">
                                            </div> --}}

                                            <!-- Location -->
                                            <div class="col-xl-12">
                                                <label for="job-location" class="form-label">Location</label>
                                                <input type="text" class="form-control" id="job-location" name="location" placeholder="Enter location">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="px-4 py-3 border-top border-block-start-dashed d-sm-flex justify-content-end">
                        <button class="btn btn-success-light m-1">
                            Submit Job <i class="bi bi-check-lg ms-2"></i>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!--End::row-1 -->