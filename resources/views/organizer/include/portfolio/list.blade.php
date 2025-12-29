<div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div>
        <h1 class="page-title fw-medium fs-18 mb-2">Portfolio List</h1>
        <div class="">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Portfolio</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">My Portfolio</div>
                <a href="/portfolio/add" class="btn btn-primary btn-sm">
                    <i class="ri-add-line"></i> Add New
                </a>
            </div>

            <div class="card-body">
                <div class="row g-4">
                    
                    @forelse($portfolios as $item)
                        <div class="col-md-4 col-lg-3"> {{-- 4 per row on lg --}}
                            <div class="card shadow-sm h-100 border-0">
                                
                                <div class="ratio ratio-16x9">
                                    <img src="{{ asset($item->image) }}" class="rounded-top" style="object-fit: cover;">
                                </div>

                                <div class="card-body d-flex flex-column">
                                    <h5 class="fw-semibold mb-1">{{ $item->title }}</h5>
                                    <p class="text-muted small mb-3">
                                        {{ Str::limit($item->description, 100) }}
                                    </p>

                                    <div class="mt-auto d-flex justify-content-between">
                                        <a href="/portfolio/edit/{{ $item->id }}" 
                                           class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('organizer.portfolio.delete', $item->id) }}" 
                                              method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @empty
                        <div class="text-center text-muted py-5 fs-16">
                            No portfolio items added yet.
                        </div>
                    @endforelse

                    {{-- Pagination --}}
                    <div class="col-12 mt-4">
                        <div class="d-flex justify-content-center">
                            {{ $portfolios->links('pagination::bootstrap-5') }}
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
