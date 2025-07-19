<!-- Page Header -->
<div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div>
        <h1 class="page-title fw-medium fs-18 mb-2">Services</h1>
        <div class="">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Services</li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $editService->service_name }}</li>
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
                <form action="{{ isset($editService) ? route('vendor.updateService', $editService->service_id) : route('vendor.storeService') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($editService))
                        @method('PUT')
                    @endif
                    <div class="p-4">
                        <div class="row gx-5">
                            <div class="col-xxl-6 col-xl-12 col-lg-12 col-md-6">
                                <div class="card custom-card shadow-none mb-0 border-0">
                                    <div class="card-body p-0">
                                        <div class="row gy-3">
                                            <!-- Title -->
                                            <div class="col-xl-6">
                                                <label for="service_name" class="form-label">Service Title</label>
                                                <input type="text" class="form-control" name="service_name" id="service_name" value="{{ old('service_name', $editService->service_name ?? '') }}" required>

                                            </div>

                                            <!-- Category (Dropdown from vendor_types) -->
                                            <div class="col-xl-6">
                                                <label for="id_type " class="form-label">Category</label>
                                                <select name="id_type" id="id_type" class="form-select" required>
                                                    <option value="">-- Select Category --</option>
                                                    @foreach($types as $type)
                                                        <option value="{{ $type->type_id }}" {{ (old('id_type', $editService->id_type ?? '') == $type->type_id) ? 'selected' : '' }}>
                                                            {{ $type->type_name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>

                                            <!-- Description -->
                                            <div class="col-xl-12">
                                                <label for="service_desc" class="form-label">Description</label>
                                                <textarea class="form-control" name="service_desc" id="service_desc" rows="4">{{ old('service_desc', $editService->service_desc ?? '') }}</textarea>
                                            </div>

                                            <!-- Price -->
                                            <div class="col-xl-6">
                                                <label for="service_price" class="form-label">Price (PKR)</label>
                                                <input type="number" step="0.01" class="form-control" name="service_price" id="service_price" value="{{ old('service_price', $editService->service_price ?? '') }}" required>

                                            </div>


                                            <div class="col-xl-6">
                                                <label for="service_status " class="form-label">Status</label>
                                               <select name="service_status" id="service_status" class="form-select" required>
                                                    <option value="">-- Select Status --</option>
                                                    <option value="1" {{ (old('service_status', $editService->service_status ?? '') == 1) ? 'selected' : '' }}>Active</option>
                                                    <option value="2" {{ (old('service_status', $editService->service_status ?? '') == 2) ? 'selected' : '' }}>Inactive</option>
                                                </select>

                                            </div>

                                            <!-- Image -->
                                            <div class="col-xl-12 product-documents-container">
                                                <p class="fw-medium mb-2 fs-14">Service Image:</p>
                                                <input type="file" class="form-control" name="service_photo" accept=".jpg, .jpeg, .png, .svg">
                                                @if(isset($editService) && $editService->service_photo)
                                                    <div class="mt-2">
                                                        <img src="{{ asset( $editService->service_photo) }}" alt="Current Image" style="max-height: 120px;">
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="px-4 py-3 border-top border-block-start-dashed d-sm-flex justify-content-end">
                            <button class="btn btn-success-light m-1">
                                {{ isset($editService) ? 'Update Service' : 'Add Service' }} <i class="bi bi-check-lg ms-2"></i>
                            </button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End::row-1 -->