<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card mt-4">
            <div class="card-body">
                <div class="contact-header">
                    <div class="d-sm-flex d-block align-items-center justify-content-between">
                        <div class="h5 fw-medium mb-0">Guests</div>
                        <div class="d-flex mt-sm-0 mt-2 align-items-center">
                            {{-- <div class="input-group">
                                <input type="text" class="form-control bg-light border-0" placeholder="Search..." aria-describedby="search-contact-member">
                                <button class="btn btn-light" type="button" id="search-contact-member"><i class="ri-search-line text-muted"></i></button>
                            </div>
                            <div class="dropdown ms-2">
                                <button class="btn btn-icon btn-primary-light btn-wave" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="javascript:void(0);">Delete All</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">Copy All</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">Move To</a></li>
                                </ul>
                            </div> --}}
                            <a href="/guests/add" class="btn btn-icon btn-secondary-light ms-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add Contact"><i class="ri-add-line"></i></a>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    @if ($guestsGroupedByEvent != null)
        @foreach($guestsGroupedByEvent as $event_id => $guests)
            @php
                $event = $guests->first(); // since all guests have the same event info
            @endphp

            {{-- Event Heading --}}
            <div class="col-12">
                <h4 class="fw-bold mt-4 mb-3 border-bottom pb-2">{{ $event->event_name }}</h4>
            </div>

            {{-- Guests under this event --}}
            @foreach($guests as $guest)
                <div class="col-xxl-2 col-xl-3 col-lg-3 col-md-4 col-sm-6">
                    <div class="card custom-card text-center">
                        <div class="card-body p-4">
                            <div class="avatar avatar-xl avatar-rounded mb-3">
                                <img src="{{ $guest->photo ? asset($guest->photo) : asset('images/default_user.png') }}" alt="guest" class="img-thumbnail">
                            </div>
                            <div class="mb-3">
                                <h6 class="mb-1 fw-medium">{{ $guest->name }}</h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-center gap-2">
                                <a href="/guests/edit/{{$guest->href}}" type="button" class="btn btn-sm btn-outline-light border">View Profile</a>
                                <button onclick="confirmDelete('guests', {{ $guest->id }}, 'id');" class="btn btn-sm btn-icon btn-outline-light btn-danger border delete-btn" type="button">
                                    <i class="ri-delete-bin-5-line"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach
    @else
        <h5 class="p-5 text-danger text-center">No guest record found!</h5>
    @endif



    
</div>