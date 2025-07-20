<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card mt-4">
            <div class="card-body">
                <div class="contact-header">
                    <div class="d-sm-flex d-block align-items-center justify-content-between">
                        <div class="h5 fw-medium mb-0">My Vendors</div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-body">
                @if($assignments->count())
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Event Name</th>
                                    <th>Client</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($assignments as $index => $assignment)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $assignment->event->event_name ?? 'N/A' }}</td>
                                        <td>{{ $assignment->client->name ?? 'N/A' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($assignment->event->event_date)->format('d M Y') }}</td>
                                        <td>
                                            <span class="badge bg-success">Accepted</span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detailModal{{ $assignment->id }}">
                                                <i class="fa-regular fa-eye"></i>
                                                Details
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @foreach($assignments as $assignment)
                            <div class="modal fade" id="detailModal{{ $assignment->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $assignment->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Request Detail</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        
                                        <div class="modal-body">
                                            <h6>Client Information</h6>
                                            <p><strong>Name:</strong> {{ $assignment->client->name }}</p>
                                            <p><strong>Email:</strong> {{ $assignment->client->email }}</p>

                                            <hr>

                                            <h6>Event Information</h6>
                                            <p><strong>Name:</strong> {{ $assignment->event->event_name }}</p>
                                            <p><strong>Location:</strong> {{ $assignment->event->event_location }}</p>
                                            <p><strong>Guests:</strong> {{ $assignment->event->no_of_guests }}</p>
                                            <p><strong>Budget:</strong> Rs. {{ $assignment->event->event_budget }}</p>
                                            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($assignment->event->event_date)->format('d M Y') }}</p>
                                            <p><strong>Details:</strong> {{ $assignment->event->event_detail }}</p>
                                        </div>

                                        <div class="modal-footer">
                                            @if ($assignment->status == 3)
                                                <form method="POST" action="{{ route('organizer.request-action') }}">
                                                    @csrf
                                                    <input type="hidden" name="assignment_id" value="{{ $assignment->id }}">
                                                    <input type="hidden" name="action" value="accept">
                                                    <button type="submit" class="btn btn-success">
                                                        <i class="fa-solid fa-check"></i>
                                                        Accept
                                                    </button>
                                                </form>

                                                <form method="POST" action="{{ route('organizer.request-action') }}">
                                                    @csrf
                                                    <input type="hidden" name="assignment_id" value="{{ $assignment->id }}">
                                                    <input type="hidden" name="action" value="reject">
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fa-solid fa-xmark"></i>
                                                        Reject
                                                    </button>
                                                </form>
                                            @endif

                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                @else
                    <div class="alert alert-danger mb-0">No bookings yet!</div>
                @endif
            </div>

        </div>
    </div>
</div>
