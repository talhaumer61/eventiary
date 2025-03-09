<div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div>
        <h1 class="page-title fw-medium fs-18 mb-2">Event Type</h1>
        <div class="">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Events</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Event Type</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Header Close -->

<!-- Start::row-1 -->
<div class="row">
    <form action="{{route('addEventType')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-body add-products p-0">
                    <div class="p-4">
                        <div class="row gx-5">
                            <div class="col-xxl-6 col-xl-12 col-lg-12 col-md-6">
                                <div class="card custom-card shadow-none mb-0 border-0">
                                    <div class="card-body p-0">
                                        <div class="row gy-3">
                                            <div class="col-xl-6">
                                                <label for="product-name-add" class="form-label"> Name</label>
                                                <input type="text" class="form-control" name="type_name" id="product-name-add" placeholder="Name">
                                            </div>
                                            <div class="col-xl-6">
                                                <label for="product-size-add" class="form-label">Status</label>
                                                <select class="form-control" data-trigger name="type_status" id="product-size-add">
                                                    <option value="">Select...</option>
                                                    <option value="1">Active</option>
                                                    <option value="2">Inactive</option>
                                                </select>
                                            </div>
                                            <div class="col-xl-12">
                                                <label for="product-description-add" class="form-label">Description</label>
                                                <textarea class="form-control" id="product-description-add" name="type_desc" rows="2"></textarea>
                                                <label for="product-description-add" class="form-label mt-1 fs-12 op-5 text-muted mb-0">*Description should not exceed 500 letters</label>
                                            </div>
                                            <div class="col-xl-12 product-documents-container">
                                                <p class="fw-medium mb-2 fs-14">Icon :</p>
                                                <input type="file" class="form-control" name="type_icon"  accept=".jpg, .jpeg, .png, .svg" required="" data-bs-original-title="" title="">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 border-top border-block-start-dashed d-sm-flex justify-content-end">
                        <a href="/event-types" class="btn btn-danger-light m-1"><i class="bi bi-arrow-left"></i> Cancel </a>
                        <button type="submit" class="btn btn-primary-light m-1">Add<i class="bi bi-plus-lg ms-2"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>