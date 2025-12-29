<div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div>
        <h1 class="page-title fw-medium fs-18 mb-2">My Team</h1>
        <div class="">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Team</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">Team Members</div>
                <a href="/team/add" class="btn btn-primary btn-sm">
                    <i class="ri-add-line"></i> Add New
                </a>
            </div>

            <div class="card-body">

                <div class="row g-4">
                    @forelse($team as $member)
                        <div class="col-md-4 col-lg-3">
                            <div class="card h-100 shadow-sm">
                                
                                <div class="ratio ratio-1x1">
                                    <img src="{{ asset($member->photo) }}" class="rounded-top" style="object-fit: cover;">
                                </div>

                                <div class="card-body d-flex flex-column">
                                    <h5 class="fw-bold mb-1">{{ $member->name }}</h5>
                                    <p class="text-muted mb-2">{{ $member->designation }}</p>
                                    <p class="small text-muted">{{ Str::limit($member->bio, 80) }}</p>

                                    <div class="mt-auto d-flex justify-content-between">
                                        <a href="/team/edit/{{ $member->id }}" class="btn btn-warning btn-sm">Edit</a>

                                        <form action="{{ route('organizer.team.delete', $member->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Delete team member?')">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @empty
                        <p class="text-center text-muted">No team members added yet.</p>
                    @endforelse

                    <div class="col-12 mt-4">
                        <div class="d-flex justify-content-center">
                            {{ $team->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
