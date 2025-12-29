<div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div>
        <h1 class="page-title fw-medium fs-18 mb-2">Events List</h1>
        <div class="">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Events</li>
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
                    My Events
                </div>
                <div class="d-flex">
                    <a href="/create-event" class="btn btn-sm btn-primary btn-wave waves-light"><i class="ri-add-line fw-medium align-middle me-1"></i> Create an Event</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Sr.</th>
                                <th scope="col">Name</th>
                                <th scope="col">Date</th>
                                <th scope="col">Address</th>
                                <th scope="col">Budget</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($myEvents as $index => $event)
                            <tr class="invoice-list">
                                <td>{{ $index + 1 }}</td> 
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="me-2 lh-1">
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="{{ asset(''.$event->event_image.'') }}" alt="">
                                            </span>
                                        </div>
                                        <div>
                                            <p class="mb-0 fw-medium">{{ $event->event_name }}</p>
                                            {{-- <p class="mb-0 fs-11 text-muted">{{ $event->event_href }}</p> --}}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($event->event_date)->format('d, M Y') }}
                                </td>
                                <td>
                                    {{ $event->event_location }}
                                </td>
                                <td>
                                    {{ $event->event_budget ? 'Rs.' . number_format($event->event_budget, 2) : 'N/A' }}
                                </td>
                                <td>
                                    <a href="/my-cards/{{$event->event_id}}" class="btn btn-primary-light btn-icon btn-sm">
                                        <i class="ri-brush-line"></i>
                                    </a>                                                                       
                                    <a href="{{ url('/my-events/' . $event->event_href) }}" class="btn btn-primary-light btn-icon btn-sm">
                                        <i class="ri-edit-line"></i>
                                    </a>                                                                       
                                    <button onclick="confirmDelete('events', {{ $event->event_id }}, 'event_id');" class="btn btn-danger-light btn-icon ms-1 btn-sm invoice-btn delete-btn">
                                        <i class="ri-delete-bin-5-line"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">No events found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                        
                    </table>
                </div>
            </div>
            <div class="card-footer border-top-0">
                {{ $myEvents->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>