<style>
.star-rating {
    display: flex;
    gap: 8px;
    font-size: 28px;
    cursor: pointer;
}

.rating-star {
    color: #ccc;
    transition: color 0.2s ease;
}

.rating-star.selected,
.rating-star:hover,
.rating-star:hover ~ .rating-star {
    color: gold;
}
</style>

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card mt-4">
            <div class="card-body">
                <div class="contact-header">
                    <div class="d-sm-flex d-block align-items-center justify-content-between">
                        <div class="h5 fw-medium mb-0">My Vendors</div>
                        <div class="d-flex mt-sm-0 mt-2 align-items-center">
                            <a href="#" class="btn btn-icon btn-secondary-light ms-2" data-bs-toggle="modal" data-bs-target="#addContactModal" data-bs-title="Add Contact">
                                <i class="ri-add-line"></i>
                            </a>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <h5 class="mb-0">My Vendor Requests</h5>
            </div>
            <div class="card-body">
                @if($requests->count())
                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Vendor Name</th>
                                <th>Event</th>
                                <th>Service</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Payment</th>
                                <th>Review</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($requests as $index => $req)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $req->vendor->name ?? 'N/A' }}</td>
                                    <td>{{ $req->event->event_name ?? 'N/A' }}</td>
                                    <td>{{ $req->service->service_name ?? 'N/A' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($req->event->event_date)->format('d M Y') }}</td>
                                    <td>
                                        @if($req->status == 3)
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif($req->status == 1)
                                            <span class="badge bg-secondary">Accepted</span>
                                        @elseif($req->status == 2)
                                            <span class="badge bg-danger">Rejected</span>
                                        @elseif($req->status == 4)
                                            <span class="badge bg-success">Completed</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($req->status == 1) 
                                                @if($req->payment_status == 'pending')
                                                    <a href="{{ route('vendor.assignment.pay', $req->id) }}" 
                                                    class="btn btn-primary btn-sm ms-1">
                                                        Pay Advance (20%)
                                                    </a>
                                                @elseif($req->payment_status == 'paid')
                                                    <span class="badge bg-success ms-1">Paid</span>
                                                @endif
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($req->status == 1 && $req->payment_status == 'paid')

                                            <button class="btn btn-warning btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#vendorReviewModal"
                                                    onclick="setVendorReviewData({{ $req->id }}, {{ $req->vendor_id }})">
                                                Submit Review
                                            </button>

                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" onclick="confirmDelete('event_vendor_assignments', {{ $req->id }}, 'id');" class="btn btn-icon btn-sm btn-danger-light delete-btn" title="Delete Service">
                                            <i class="ri-delete-bin-line"></i>
                                        </a> 
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                    <div class="alert alert-danger mb-0">No vendor requests yet.</div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addContactModal" tabindex="-1" aria-labelledby="addContactModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Add Vendor Request</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
            <form id="vendorForm" action="{{route('vendor.assignment.submit')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="vendorSelect" class="form-label">Select Vendor</label>
                    <select class="form-select" id="vendorSelect" name="vendor_id" required>
                    <option value="">-- Select Vendor --</option>
                    @foreach($vendors as $vendor)
                        <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                    @endforeach
                    </select>
                </div>

                <div class="mb-3" id="vendorServicesWrapper" style="display: none;">
                    <label class="form-label">Select Service</label>
                    <select class="form-select" id="vendorServiceSelect" name="service_id" required>
                    <option value="">-- Select Service --</option>
                    <!-- Options populated via JS -->
                    </select>
                </div>

                <div class="mb-3">
                    <label for="assignmentSelect" class="form-label">Select Event Assignment</label>
                    <select class="form-select" name="event_id" required>
                    <option value="">-- Select Event --</option>
                    @foreach($assignments as $assignment)
                        <option value="{{ $assignment->id }}">
                        {{ $assignment->event->event_name }} - {{ \Carbon\Carbon::parse($assignment->event->event_date)->format('d M Y') }}
                        </option>
                    @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="assignmentDescription" class="form-label">Description</label>
                    <textarea class="form-control" id="assignmentDescription" name="description" rows="3" placeholder="Write a short note about this assignment..."></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Request</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
      </div>
    </div>
  </div>
</div>

<script>
  document.getElementById('vendorSelect').addEventListener('change', function () {
    let vendorId = this.value;

    if (vendorId) {
      fetch(`/organizer/vendor-services/${vendorId}`)
        .then(response => response.json())
        .then(data => {
          let serviceSelect = document.getElementById('vendorServiceSelect');
          serviceSelect.innerHTML = '<option value="">-- Select Service --</option>';

          if (data.length > 0) {
            document.getElementById('vendorServicesWrapper').style.display = 'block';
            data.forEach(service => {
              let option = document.createElement('option');
              option.value = service.service_id;
              option.text = service.service_name + ' - Rs ' + service.service_price;
              serviceSelect.appendChild(option);
            });
          } else {
            document.getElementById('vendorServicesWrapper').style.display = 'none';
          }
        });
    } else {
      document.getElementById('vendorServicesWrapper').style.display = 'none';
    }
  });
</script>

<!-- Submit Vendor Review Modal -->
<div class="modal fade" id="vendorReviewModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('client.vendor.submit.review') }}" method="POST">
      @csrf

      <input type="hidden" name="assignment_id" id="vendor_review_assignment_id">
      <input type="hidden" name="from" value="{{ auth()->id() }}">
      <input type="hidden" name="to" id="vendor_review_vendor_id">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Submit Review</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

          <label class="form-label">Rating</label>

          <div class="star-rating mb-3">
              <i class="rating-star ri-star-line" data-value="1"></i>
              <i class="rating-star ri-star-line" data-value="2"></i>
              <i class="rating-star ri-star-line" data-value="3"></i>
              <i class="rating-star ri-star-line" data-value="4"></i>
              <i class="rating-star ri-star-line" data-value="5"></i>
          </div>

          <input type="hidden" name="rating" id="vendor_rating_value" required>

          <label class="form-label mt-3">Review</label>
          <textarea name="review" rows="4" class="form-control" required placeholder="Write your review..."></textarea>

        </div>

        <div class="modal-footer">
          <button class="btn btn-primary" type="submit">Submit Review</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script>
function setVendorReviewData(assignmentId, vendorId) {
    document.getElementById('vendor_review_assignment_id').value = assignmentId;
    document.getElementById('vendor_review_vendor_id').value = vendorId;
}
</script>
<script>
document.querySelectorAll("#vendorReviewModal .rating-star").forEach(star => {
    star.addEventListener("click", function () {
        let value = this.getAttribute("data-value");
        document.getElementById("vendor_rating_value").value = value;

        // reset
        document.querySelectorAll("#vendorReviewModal .rating-star")
                .forEach(s => s.classList.remove("selected"));

        for (let i = 1; i <= value; i++) {
            document.querySelector('#vendorReviewModal .rating-star[data-value="'+i+'"]')
                .classList.add("selected");
        }
    });
});
</script>

