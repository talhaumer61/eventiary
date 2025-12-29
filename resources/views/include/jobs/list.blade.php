
<section class="ttm-row upcoming-event-section py-5">
    <div class="container">
        <h2 class="mb-4">Available Jobs</h2>

        <div class="row">
            @forelse($jobs as $job)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body d-flex flex-column">
                            
                            <h5 class="card-title">{{ $job->title }}</h5>
                            <p class="text-muted mb-1"><strong>Location:</strong> {{ $job->location ?? 'Not mentioned' }}</p>

                            <div class="mt-auto d-flex justify-content-between">
                                <!-- VIEW DETAILS BTN -->
                                <button class="btn btn-outline-info btn-sm"
                                        data-bs-toggle="offcanvas"
                                        data-bs-target="#jobDetailCanvas"
                                        onclick="loadJobDetails({{ $job->id }})">
                                    View Details
                                </button>


                                <!-- APPLY BTN -->
                                <button class="btn btn-primary btn-sm"
                                        data-bs-toggle="offcanvas"
                                        data-bs-target="#applyCanvas"
                                        onclick="setApplyJobId({{ $job->id }})">
                                    Apply
                                </button>

                            </div>

                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-muted">No open jobs available right now.</p>
            @endforelse
        </div>
    </div>
</section>

<div class="offcanvas offcanvas-end" tabindex="-1" id="jobDetailCanvas">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title">Job Details</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body" id="jobCanvasBody">
    <p class="text-muted text-center">Loading...</p>
  </div>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="applyCanvas">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title">Apply for Job</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
  </div>

  <div class="offcanvas-body">
    <form id="applyForm" method="POST">
      @csrf

      <div class="mb-3">
        <label>Full Name</label>
        <input name="name" class="form-control" required>
      </div>

      <div class="mb-3">
        <label>Email</label>
        <input name="email" type="email" class="form-control" required>
      </div>

      <div class="mb-3">
        <label>Phone</label>
        <input name="phone" class="form-control" required>
      </div>

      <div class="mb-3">
        <label>Cover Letter</label>
        <textarea name="cover_letter" class="form-control" required></textarea>
      </div>

      <button type="submit" class="btn btn-success w-100">Submit</button>
    </form>
  </div>
</div>

<script>
  function loadJobDetails(jobId) {
      let body = document.getElementById("jobCanvasBody");
      body.innerHTML = "<p class='text-center text-muted'>Loading...</p>";

      fetch(`/job-detail/${jobId}`)
          .then(res => res.json())
          .then(job => {
              body.innerHTML = `
                  <h4>${job.title}</h4>
                  <p>${job.description}</p>
                  <p><strong>Category:</strong> ${job.category ?? "N/A"}</p>
                  <p><strong>Budget:</strong> ${job.budget ?? "N/A"}</p>
                  <p><strong>Location:</strong> ${job.location ?? "N/A"}</p>
                  <p><strong>Event:</strong> ${job.event?.name ?? "N/A"}</p>
                  <p><strong>Posted by:</strong> ${job.user?.name ?? "N/A"}</p>
              `;
          })
          .catch(() => {
              body.innerHTML = "<p class='text-danger text-center'>Error loading job.</p>";
          });
  }
</script>

<script>
  function setApplyJobId(jobId) {
      document.getElementById("applyForm").action = `/jobs/${jobId}/apply`;
  }
</script>
