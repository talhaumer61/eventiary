<!-- Page Header -->
<div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div>
        <h1 class="page-title fw-medium fs-18 mb-2">Add Team</h1>
        <div class="">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Team</li>
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
                <h5 class="card-title">Add New Member</h5>
            </div>

            <div class="card-body">

                <form action="{{ route('organizer.team.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3">

                        <!-- Name -->
                        <div class="col-md-6">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" required placeholder="Enter team member name">
                        </div>

                        <!-- Designation -->
                        <div class="col-md-6">
                            <label class="form-label">Designation</label>
                            <input type="text" name="designation" class="form-control" required placeholder="e.g. Photographer">
                        </div>

                        <!-- Bio -->
                        <div class="col-md-12">
                            <label class="form-label">Short Bio</label>
                            <textarea name="bio" class="form-control" rows="4" placeholder="Write a short bio..."></textarea>
                        </div>

                        <!-- Photo -->
                        <div class="col-md-6">
                            <label class="form-label">Photo</label>
                            <input type="file" name="photo" class="form-control" accept="image/*">
                        </div>

                        <!-- Social Links -->
                        <div class="col-md-6">
                            <label class="form-label">Facebook (optional)</label>
                            <input type="url" name="facebook" class="form-control" placeholder="https://facebook.com/username">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Instagram (optional)</label>
                            <input type="url" name="instagram" class="form-control" placeholder="https://instagram.com/username">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">LinkedIn (optional)</label>
                            <input type="url" name="linkedin" class="form-control" placeholder="https://linkedin.com/in/username">
                        </div>

                    </div>

                    <div class="mt-4">
                        <button class="btn btn-primary">Add Member</button>
                        <a href="{{ route('organizer.team.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>
<!--End::row-1 -->