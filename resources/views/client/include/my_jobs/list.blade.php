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
                <div class="table-responsive">
                    @forelse($jobs as $job)
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5>{{ $job->title }}</h5>
                                <p>{{ Str::limit($job->description, 100) }}</p>
                                <p><strong>Budget:</strong> {{ $job->budget ?? 'N/A' }}</p>

                                <!-- Applications Button -->
                                <button class="btn btn-info ms-2"
                                        data-bs-toggle="modal"
                                        data-bs-target="#applicationsModal"
                                        onclick="loadApplications({{ $job->id }})">
                                    Applications <span class="badge bg-dark">{{ $job->applications->count() }}</span>
                                </button>

                            </div>
                        </div>
                    @empty
                        <div class="p-4 text-center">
                            <p>No jobs found. <a class="fw-bold btn btn-outline-success" href="/my-jobs/create">Create a new job</a></p>
                        </div>
                    @endforelse
                </div>
                <div class="card-footer">
                    {{ $jobs->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Applications Modal -->
<div class="modal fade" id="applicationsModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Job Applications</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body" id="applicationsModalBody">
        <p class="text-center text-muted">Loading...</p>
      </div>

    </div>
  </div>
</div>

<script>
    function loadApplications(jobId) {
        let body = document.getElementById('applicationsModalBody');
        body.innerHTML = '<p class="text-center text-muted">Loading...</p>';

        fetch(`/my-jobs/${jobId}/applications`)
            .then(res => {
                if (!res.ok) throw new Error("API failed");
                return res.json();
            })
            .then(apps => {
                if (apps.length === 0) {
                    body.innerHTML = '<p class="text-center text-muted">No applications yet.</p>';
                    return;
                }

                let html = `<ul class="list-group">`;

                apps.forEach(app => {
                    html += `
                        <li class="list-group-item">
                            <h6>${app.name ?? 'No Name'}</h6>
                            <p><strong>Email:</strong> ${app.email ?? 'N/A'}</p>
                            <p><strong>Phone:</strong> ${app.phone ?? 'N/A'}</p>
                            <p><strong>Cover Letter:</strong><br>${app.cover_letter ?? ''}</p>
                            <p class="text-muted small">Applied on: ${app.created_at}</p>
                        </li>
                    `;
                });

                html += `</ul>`;
                body.innerHTML = html;
            })
            .catch(err => {
                console.log(err);
                body.innerHTML = '<p class="text-danger text-center">Unable to load applications.</p>';
            });
    }

</script>

