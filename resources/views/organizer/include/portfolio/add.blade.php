<!-- Page Header -->
<div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div>
        <h1 class="page-title fw-medium fs-18 mb-2">Add Portfolio</h1>
        <div class="">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Portfolio</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Portfolio</li>
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
            <div class="card-header">
                <div class="card-title">Add Portfolio Item</div>
            </div>

            <div class="card-body">
                <form action="{{ route('organizer.portfolio.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <label>Title</label>
                    <input name="title" class="form-control" required>

                    <label class="mt-3">Description</label>
                    <textarea name="description" class="form-control"></textarea>

                    <label class="mt-3">Portfolio Image</label>
                    <input type="file" name="image" class="form-control" required>

                    <button class="btn btn-primary mt-3">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End::row-1 -->