<div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div>
        <h1 class="page-title fw-medium fs-18 mb-2">Organizers List</h1>
        <div class="">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Organizers</li>
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
                <a href="#" class="btn btn-sm btn-primary btn-wave waves-light" data-bs-toggle="modal" data-bs-target="#chooseOrganizerModal">
                    <i class="ri-add-line fw-medium align-middle me-1"></i> Choose an Organizer
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Sr.</th>
                                <th scope="col">Event</th>
                                <th scope="col">Organizer</th>
                                <th scope="col">Date</th>
                                <th scope="col">Address</th>
                                <th scope="col">Budget</th>
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
                                        <td class="fw-bold">{{ $assignment->organizer->name ?? 'N/A' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($assignment->event->event_date)->format('d F Y') }}</td>
                                        <td>{{ $assignment->event->event_location ?? 'N/A' }}</td>
                                        <td>{{ $assignment->event->event_budget ?? 'N/A' }}</td>
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
                                            <button onclick="confirmDelete('event_organizer_assignments', {{ $assignment->id }}, 'id');" 
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



<!-- Choose Organizer Modal -->
<div class="modal fade" id="chooseOrganizerModal" tabindex="-1" aria-labelledby="chooseOrganizerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="{{ route('client.assign.organizer') }}" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="chooseOrganizerModalLabel">Choose Organizer</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body row g-3">
            <div class="col-md-6">
                <label for="event_id" class="form-label">Select Event</label>
                <select name="event_id" id="event_id" class="form-select" required>
                    <option value="">-- Select Event --</option>
                    @foreach($events as $event)
                        <option value="{{ $event->event_id }}">{{ $event->event_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label for="organizer_id" class="form-label">Select Organizer</label>
                <select name="organizer_id" id="organizer_id" class="form-select" required>
                    <option value="">-- Select Organizer --</option>
                    @foreach($organizers as $organizer)
                        <option value="{{ $organizer->id }}">{{ $organizer->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-12">
                <label for="description" class="form-label">Description (optional)</label>
                <textarea name="description" class="form-control" rows="3" placeholder="Add any brief for the organizer..."></textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Assign Organizer</button>
        </div>
      </div>
    </form>
  </div>
</div>
