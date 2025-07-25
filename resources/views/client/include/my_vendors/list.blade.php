<div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div>
        <h1 class="page-title fw-medium fs-18 mb-2">Vendors List</h1>
        <div class="">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Vendors</li>
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
                    My Organizers
                </div>
                <a href="#" class="btn btn-sm btn-primary btn-wave waves-light" data-bs-toggle="modal" data-bs-target="#chooseVendorModal">
                    <i class="ri-add-line fw-medium align-middle me-1"></i> Choose a Vendor
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Sr.</th>
                                <th scope="col">Event</th>
                                <th scope="col">Date</th>
                                <th scope="col">Vendor</th>
                                <th scope="col">Service</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($assignments->count())
                                @foreach($assignments as $index => $assignment)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td class="fw-bold">{{ $assignment->event->event_name ?? 'N/A' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($assignment->event->event_date)->format('d F Y') }}</td>
                                        <td>{{ $assignment->vendor->name ?? 'N/A' }}</td>
                                        <td>{{ $assignment->service->service_name ?? 'N/A' }}</td>
                                        <td>
                                            @php
                                                $status = [
                                                    1 => ['label' => 'Accepted', 'class' => 'success'],
                                                    2 => ['label' => 'Rejected', 'class' => 'danger'],
                                                    3 => ['label' => 'Pending', 'class' => 'warning'],
                                                ];
                                            @endphp
                                            <span class="badge bg-{{ $status[$assignment->status]['class'] }}">
                                                {{ $status[$assignment->status]['label'] }}
                                            </span>
                                        </td>
                                        <td>
                                            <button onclick="confirmDelete('event_vendor_assignments', {{ $assignment->id }}, 'id');" 
                                                    class="btn btn-danger-light btn-icon ms-1 btn-sm delete-btn" title="Delete Assignment">
                                                <i class="ri-delete-bin-5-line"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8" class="text-center text-danger">No data found!</td>
                                </tr>
                            @endif

                        </tbody>

                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Choose Vendor Modal -->
<div class="modal fade" id="chooseVendorModal" tabindex="-1" aria-labelledby="chooseVendorModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="{{ route('client.assign.vendor') }}" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="chooseVendorModalLabel">Choose Vendor</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body row g-3">

            <div class="col-md-4">
                <label for="event_id" class="form-label">Select Event</label>
                <select name="event_id" id="event_id" class="form-select" required>
                    <option value="">-- Select Event --</option>
                    @foreach($events as $event)
                        <option value="{{ $event->event_id }}">{{ $event->event_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label for="vendor_id" class="form-label">Select Vendor</label>
                <select name="vendor_id" id="vendor_id" class="form-select" required onchange="fetchVendorServices(this.value)">
                    <option value="">-- Select Vendor --</option>
                    @foreach($vendors as $vendor)
                        <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label for="service_id" class="form-label">Select Service</label>
                <select name="service_id" id="service_id" class="form-select" required>
                    <option value="">-- Select Service --</option>
                </select>
            </div>

            <div class="col-12">
                <label for="description" class="form-label">Description (optional)</label>
                <textarea name="description" class="form-control" rows="3" placeholder="Add any brief for the vendor..."></textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Send Request</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script>
function fetchVendorServices(vendorId) {
    if (!vendorId) return;

    fetch(`/vendor/${vendorId}/services`)
        .then(res => res.json())
        .then(data => {
            let serviceSelect = document.getElementById('service_id');
            serviceSelect.innerHTML = '<option value="">-- Select Service --</option>';

            data.forEach(service => {
                let opt = document.createElement('option');
                opt.value = service.service_id;
                opt.text = service.service_name + ' (Rs. ' + service.service_price + ')';
                serviceSelect.appendChild(opt);
            });
        });
}
</script>
