<div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div>
        <h1 class="page-title fw-medium fs-18 mb-2">Vendor Types</h1>
        <div class="">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Vendors</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Vendor Types</li>
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
            <div class="card-header justify-content-between">
                <div class="card-title">
                    Types List
                </div>
                <div class="btn-list">
                    <a href="/vendor-types/add" class="btn btn-primary-light btn-wave me-2">
                        <i class="bx bx-plus align-middle"></i> Add
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive mb-4">
                    @if ($vendorTypes->count() > 0)
                        <table class="table text-nowrap table-bordered">
                            <thead>
                                <tr>
                                    <th>Sr #</th>
                                    <th>Name</th>
                                    <th class="text-center">Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $srNo = 1; @endphp
                                @foreach($vendorTypes as $vendorType)
                                    <tr class="product-list">
                                        <td>{{ $srNo++ }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="me-2">
                                                    <span class="avatar avatar-md avatar-rounded">
                                                        <img src="{{ asset($vendorType->type_icon) }}" alt="">
                                                    </span>
                                                </div>
                                                <div class="fw-medium">
                                                    {{ $vendorType->type_name }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            {!! get_status($vendorType->type_status) !!}
                                        </td>
                                        <td>
                                            <div class="hstack gap-2 fs-15">
                                                <a href="{{ url('/vendor-types/edit/' . $vendorType->type_href) }}" class="btn btn-icon btn-sm btn-info-light">
                                                    <i class="ri-edit-line"></i>
                                                </a>
                                                <a href="#" onclick="confirmDelete('vendor_types', {{ $vendorType->type_id }}, 'type_id');" class="btn btn-icon btn-sm btn-danger-light product-btn delete-btn">
                                                    <i class="ri-delete-bin-line"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-3">
                            {{ $vendorTypes->links('pagination::bootstrap-5') }}
                        </div>
                    @else
                        <h2 class="text-center text-danger bg-light rounded p-4">No Record Found!</h2>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>