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
                    <h2>{{ $job->title }}</h2>
                    <p>{{ $job->description }}</p>
                    <p><strong>Budget:</strong> {{ $job->budget }}</p>
                    <p><strong>Event:</strong> {{ $job->event->event_name ?? 'N/A' }}</p>

                    @if(auth()->id() != $job->user_id)
                        <form action="{{ route('jobs.apply', $job->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label>Cover Letter</label>
                                <textarea name="cover_letter" rows="3" class="form-control"></textarea>
                            </div>
                            <button class="btn btn-primary">Apply Now</button>
                        </form>
                    @else
                        <h4>Applications</h4>
                        @forelse($job->applications as $app)
                            <div class="border p-3 mb-2">
                                <strong>{{ $app->applicant->name }}</strong>
                                <p>{{ $app->cover_letter }}</p>
                                <form action="{{ route('applications.respond', $app->id) }}" method="POST">
                                    @csrf
                                    <select name="status" class="form-select d-inline w-auto">
                                        <option value="pending" {{ $app->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="accepted" {{ $app->status == 'accepted' ? 'selected' : '' }}>Accept</option>
                                        <option value="rejected" {{ $app->status == 'rejected' ? 'selected' : '' }}>Reject</option>
                                    </select>
                                    <button class="btn btn-sm btn-success">Update</button>
                                </form>
                            </div>
                        @empty
                            <p>No applications yet.</p>
                        @endforelse
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>