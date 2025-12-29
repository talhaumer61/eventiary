<div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div>
        <h1 class="page-title fw-medium fs-18 mb-2">Jobs Posted</h1>
        <div class="">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Jobs</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    All Jobs Posted
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Job Title</th>
                                <th scope="col">Posted By</th>
                                <th scope="col">Event</th>
                                <th scope="col">Budget</th>
                                <th scope="col">Status</th>
                                <th scope="col">Posted On</th>
                            </tr>
                        </thead>

                        <tbody>
                        @forelse($jobs as $job)
                            <tr>
                                <!-- Job Title -->
                                <td>
                                    <strong>{{ $job->title }}</strong><br>
                                    <small class="text-muted">{{ $job->category }}</small>
                                </td>

                                <!-- Posted By -->
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="me-2 lh-1">
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="{{ asset($job->user_photo ?? 'dashboard/images/default.png') }}" alt="">
                                            </span>
                                        </div>
                                        <div>
                                            <p class="mb-0 fw-medium">{{ $job->user_name }}</p>
                                            <p class="mb-0 fs-11 text-muted">{{ $job->user_email }}</p>
                                        </div>
                                    </div>
                                </td>

                                <!-- Event -->
                                <td>
                                    {{ $job->event_name ?? 'No Event' }}
                                </td>

                                <!-- Budget -->
                                <td>
                                    Rs {{ number_format($job->budget, 0) }}
                                </td>

                                <!-- Status -->
                                <td>
                                    @php
                                        $status = [
                                            'closed' => ['label' => 'Inactive', 'class' => 'danger'],
                                            'open' => ['label' => 'Active', 'class' => 'success'],
                                        ];
                                    @endphp

                                    <span class="badge bg-{{ $status[$job->status]['class'] }}-transparent">
                                        {{ $status[$job->status]['label'] }}
                                    </span>
                                </td>

                                <!-- Created Date -->
                                <td>
                                    {{ $job->created_at ? $job->created_at->format('d M, Y') : 'N/A' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    No jobs found.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
