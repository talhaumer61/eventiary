<div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div>
        <h1 class="page-title fw-medium fs-18 mb-2">Payments List</h1>
        <div class="">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Payments</li>
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
                    Payments
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Sender</th>
                                <th scope="col">Date</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($payments as $payment)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="me-2 lh-1">
                                                <span class="avatar avatar-sm avatar-rounded">
                                                    <img src="{{ asset($payment->receiver_photo) }}" alt="">
                                                </span>
                                            </div>
                                            <div>
                                                <p class="mb-0 fw-medium">{{ $payment->receiver_name }}</p>
                                                <p class="mb-0 fs-11 text-muted">{{ $payment->receiver_email }}</p>
                                            </div>
                                        </div>
                                    </td>

                                    <td>{{ $payment->paid_at ? date('d M, Y', strtotime($payment->paid_at)) : 'N/A' }}</td>

                                    <td>Rs {{ number_format($payment->advance_amount, 0) }}</td>

                                    <td>
                                        @if($payment->released_at)
                                            <span class="badge bg-success-transparent">Received</span>
                                        @else
                                            <span class="badge bg-warning-transparent">Pending</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">
                                        No payments found.
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