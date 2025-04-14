<!-- Page Header -->
<div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div>
        <h1 class="page-title fw-medium fs-18 mb-2">Create Event</h1>
        <div class="">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create an Event</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Header Close -->

<!-- Start::row-1 -->
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-body add-products p-0">
                <form action="{{ route('event.update', $event->event_href) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="event_href" value="{{ $event->event_href }}">
                    <div class="p-4">
                        <div class="row gx-5">
                            <div class="col-xxl-6 col-xl-12 col-lg-12 col-md-6">
                                <div class="card custom-card shadow-none mb-0 border-0">
                                    <div class="card-body p-0">
                                        <div class="row gy-3">
                                            <div class="col-xl-12">
                                                <label for="product-name-add" class="form-label">Title</label>
                                                <input type="text" class="form-control" id="product-name-add" name="event_name" value="{{ $event->event_name }}">
                                            </div>
                                            <div class="col-xl-6">
                                                <label for="product-color-add" class="form-label">Type</label>
                                                <select class="form-control" name="id_type">
                                                    <option>Select...</option>
                                                    @foreach($eventTypes as $type)
                                                        <option value="{{ $type->type_id }}" {{ $event->id_type == $type->type_id ? 'selected' : '' }}>
                                                            {{ $type->type_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-xl-6">
                                                <label for="product-cost-add" class="form-label">Address</label>
                                                <input type="text" class="form-control" name="event_location" id="product-cost-add" value="{{ $event->event_location }}">
                                            </div>
                                            <div class="col-xl-6">
                                                <label for="product-cost-add" class="form-label">No of Guests <span class="text-danger">(Est. Max)</span></label>
                                                <input type="number" class="form-control" name="no_of_guests" id="product-cost-add" value="{{ $event->no_of_guests }}" min="0" step="1">
                                            </div>
                                            <div class="col-xl-6">
                                                <label for="product-cost-add" class="form-label">Budget</label>
                                                <input type="text" class="form-control" name="event_budget" id="product-cost-add" value="{{ $event->event_budget }}">
                                            </div>
                                            <div class="col-xl-6">
                                                <label for="product-type" class="form-label">Date</label>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-text text-muted"> <i class="ri-calendar-line"></i> </div>
                                                        <input type="date" class="form-control flatpickr-input" name="event_date" id="date" value="{{ \Carbon\Carbon::parse($event->event_date)->format('Y-m-d') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <label for="product-description-add" class="form-label">Detail</label>
                                                <textarea class="form-control" id="product-description-add" rows="3" name="event_detail">{{ $event->event_detail }}</textarea>
                                            </div>
                                            <div class="col-xl-12 product-documents-container">
                                                <p class="fw-medium mb-2 fs-14">Event Image (Leave empty to keep current):</p>
                                                <input type="file" class="form-control" name="event_image" accept=".jpg, .jpeg, .png, .svg">
                                                @if($event->event_image)
                                                    <div class="mt-2">
                                                        <img src="{{ asset('' . $event->event_image.'') }}" width="100" alt="Event Image">
                                                    </div>
                                                @endif
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="px-4 py-3 border-top border-block-start-dashed d-sm-flex justify-content-end">
                        <button class="btn btn-success-light m-1">Update Event<i class="bi bi-check-lg ms-2"></i></button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>
<!--End::row-1 -->