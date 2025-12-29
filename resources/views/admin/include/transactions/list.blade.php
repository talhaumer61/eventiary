<div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div>
        <h1 class="page-title fw-medium fs-18 mb-2">Transactions List</h1>
        <div class="">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Transactions</li>
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
                    Transactions
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Client</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Released Amount</th>
                                <th scope="col">Commission</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($payments as $payment)
                                <tr class="invoice-list">

                                    <!-- Sender + Receiver -->
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="me-2 lh-1">
                                                <span class="avatar avatar-sm avatar-rounded">
                                                    <img src="{{ asset($payment->from_photo ?: 'dashboard/images/default.png') }}" alt="">
                                                </span>
                                            </div>
                                            <div>
                                                <p class="mb-0 fw-medium">
                                                    {{ $payment->from_name ?? 'Unknown User' }} → {{ $payment->to_name ?? 'Unknown User' }}
                                                </p>
                                                <p class="mb-0 fs-11 text-muted">{{ $payment->from_email }} → {{ $payment->to_email }}</p>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Status -->
                                    <td>
                                        @if($payment->released_at)
                                            <span class="badge bg-success-transparent">Released</span>
                                        @else
                                            <span class="badge bg-warning-transparent">Pending</span>
                                        @endif
                                    </td>

                                    <!-- Issued Date -->
                                    <td>
                                        {{ $payment->paid_at ? date('d M Y', strtotime($payment->paid_at)) : 'N/A' }}
                                    </td>

                                    <!-- Amount -->
                                    <td>
                                        Rs {{ number_format($payment->advance_amount, 0) }}
                                    </td>

                                    <td>
                                        Rs {{ number_format($payment->amount_transferred, 0) }}
                                    </td>
                                    
                                    <td>
                                        Rs {{ number_format($payment->commission, 0) }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">
                                        No transactions found.
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