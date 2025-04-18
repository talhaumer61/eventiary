<!-- Page Header -->
<div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div>
        <h1 class="page-title fw-medium fs-18 mb-2">Guests</h1>
        <div class="">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Guests</li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $guest->name }}</li>
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
                <form action="{{ isset($guest) ? route('guests.update', $guest->href) : '' }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="p-4">
                        <div class="row gx-5">
                            <div class="col-xxl-6 col-xl-12 col-lg-12 col-md-6">
                                <div class="card custom-card shadow-none mb-0 border-0">
                                    <div class="card-body p-0">
                                        <div class="row gy-3">
                                            <div class="col-xl-6">
                                                <label for="product-name-add" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="product-name-add" name="name" value="{{ $guest->name ?? '' }}">
                                            </div>
                                            <div class="col-xl-6">
                                                <label for="product-color-add" class="form-label">Event</label>
                                                <select class="form-control" name="id_event">
                                                    <option>Select...</option>
                                                    @foreach($events as $event)
                                                        <option value="{{ $event->event_id }}" {{ isset($guest) && $guest->id_event == $event->event_id ? 'selected' : '' }}>
                                                            {{ $event->event_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-xl-12">
                                                <label for="product-cost-add" class="form-label">Address</label>
                                                <input type="text" class="form-control" name="address" id="product-cost-add" value="{{ $guest->address ?? '' }}">
                                            </div>
                                            <div class="col-xl-12 product-documents-container">
                                                <p class="fw-medium mb-2 fs-14">Photo:</p>
                                                @if (isset($guest) && $guest->photo)
                                                    <img src="{{ asset('' . $guest->photo.'') }}" alt="Photo" class="img-thumbnail mb-2" width="120">
                                                @endif
                                                <input type="file" class="form-control" name="photo" accept=".jpg, .jpeg, .png, .svg">
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="px-4 py-3 border-top border-block-start-dashed d-sm-flex justify-content-end">
                        <button class="btn btn-success-light m-1">Update Guest<i class="bi bi-check-lg ms-2"></i></button>
                    </div>
                </form>
                
                
            </div>
        </div>
    </div>
</div>
<!--End::row-1 -->