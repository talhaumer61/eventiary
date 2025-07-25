<div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div>
        <h1 class="page-title fw-medium fs-18 mb-2">Event List</h1>
        <div class="">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Events</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Event List</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- Start::row-1 -->
<div class="row">   
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    Events
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive mb-4">
                    <table class="table text-nowrap table-bordered">
                        <thead>
                            <tr>
                                <th>Sr.</th>
                                <th>Event Name</th>
                                <th>Client</th>
                                <th>Location</th>
                                <th>Budget</th>
                                <th>Est. Guests</th>
                                <th>Date</th>
                                <th>Type</th>
                                {{-- <th>Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $event)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($event->event_image)
                                            <img src="{{ asset( $event->event_image) }}" width="50" class="me-2 rounded">
                                        @endif
                                        {{ $event->event_name }}
                                    </div>
                                </td>
                                <td>{{ $event->user->name ?? 'N/A' }}</td>
                                <td>{{ $event->event_location }}</td>
                                <td>Rs. {{ number_format($event->event_budget) }}</td>
                                <td>{{ $event->no_of_guests }}</td>
                                <td>{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}</td>
                                <td>{{ $event->eventType->type_name ?? 'N/A' }}</td>
                                {{-- <td>
                                    <a href="#" class="btn btn-sm btn-info"><i class="ri-edit-line"></i></a>
                                    <a href="#" class="btn btn-sm btn-danger"><i class="ri-delete-bin-line"></i></a>
                                </td> --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>