<!-- Page Header -->
<div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div>
        <h1 class="page-title fw-medium fs-18 mb-2">My Portfolio</h1>
        <div class="">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Portfolio</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Portfolio</li>
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
                <h5 class="card-title">Update Member Details</h5>
            </div>

            <div class="card-body">

                <form action="{{ route('organizer.team.update', $member->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3">

                        <!-- Name -->
                        <div class="col-md-6">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ $member->name }}" required>
                        </div>

                        <!-- Designation -->
                        <div class="col-md-6">
                            <label class="form-label">Designation</label>
                            <input type="text" name="designation" class="form-control"
                                value="{{ $member->designation }}" required>
                        </div>

                        <!-- Bio -->
                        <div class="col-md-12">
                            <label class="form-label">Short Bio</label>
                            <textarea name="bio" class="form-control" rows="4">{{ $member->bio }}</textarea>
                        </div>

                        <!-- Old Photo Preview -->
                        <div class="col-md-4">
                            <label class="form-label d-block">Current Photo</label>

                            @if($member->photo)
                                <img src="{{ asset($member->photo) }}" class="rounded" 
                                    style="width: 150px; height:150px; object-fit:cover;">
                            @else
                                <p class="text-muted">No photo uploaded</p>
                            @endif
                        </div>

                        <!-- New Photo -->
                        <div class="col-md-8">
                            <label class="form-label">Upload New Photo</label>
                            <input type="file" name="photo" class="form-control" accept="image/*">
                        </div>

                        <!-- Social Links -->
                        <div class="col-md-6">
                            <label class="form-label">Facebook</label>
                            <input type="url" name="facebook" class="form-control"
                                value="{{ $member->facebook }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Instagram</label>
                            <input type="url" name="instagram" class="form-control"
                                value="{{ $member->instagram }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">LinkedIn</label>
                            <input type="url" name="linkedin" class="form-control"
                                value="{{ $member->linkedin }}">
                        </div>

                    </div>

                    <div class="mt-4">
                        <button class="btn btn-primary">Update Member</button>
                        <a href="{{ route('organizer.team.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>
<!--End::row-1 -->