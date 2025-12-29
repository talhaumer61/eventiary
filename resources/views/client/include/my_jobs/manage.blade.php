<div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div>
        <h1 class="page-title fw-medium fs-18 mb-2">Jobs List</h1>
        <div class="">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Jobs</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    My Jobs
                </div>
                <div class="d-flex">
                    <a href="/my-jobs/create" class="btn btn-sm btn-primary btn-wave waves-light"><i class="ri-add-line fw-medium align-middle me-1"></i> Post a Job</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="container">
                    <h2>Manage My Jobs</h2>

                    @foreach($jobs as $job)
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5>{{ $job->title }} ({{ $job->status }})</h5>
                                <p>{{ Str::limit($job->description, 100) }}</p>
                                <p>Applications: {{ $job->applications->count() }}</p>
                                <a href="/my-jobs/show/{{$job->id}}" class="btn btn-outline-primary btn-sm">View Applications</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>