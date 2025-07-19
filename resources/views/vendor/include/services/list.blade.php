<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card mt-4">
            <div class="card-body">
                <div class="contact-header">
                    <div class="d-sm-flex d-block align-items-center justify-content-between">
                        <div class="h5 fw-medium mb-0">My Services</div>
                        <div class="d-flex mt-sm-0 mt-2 align-items-center">
                            <a href="/my-services/add" class="btn btn-icon btn-secondary-light ms-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add Contact"><i class="ri-add-line"></i></a>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-body">
                @if($services->count())
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Added On</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($services as $index => $service)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            @if($service->service_photo)
                                                <img src="{{ asset($service->service_photo) }}" width="60" height="60" style="object-fit: cover;" />
                                            @else
                                                N/A
                                            @endif
                                            {{ $service->service_name }}
                                        </td>
                                        <td>
                                            {{ optional($types->firstWhere('type_id', $service->id_type))->type_name ?? 'N/A' }}
                                        </td>
                                        <td>{{ $service->service_price ?? 'N/A' }}</td>
                                        <td>
                                            @if($service->service_status == 1)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($service->date_added)->format('d M Y') }}</td>
                                        <td>
                                            <a href="/my-services/edit/{{ $service->service_href }}" class="btn btn-sm btn-warning">Edit</a>
                                            <a href="javascript:void(0);" onclick="confirmDelete('vendor_services', {{ $service->service_id }}, 'service_id');" class="btn btn-icon btn-sm btn-danger-light delete-btn" title="Delete Service">
                                                <i class="ri-delete-bin-line"></i>
                                            </a> 
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-danger mb-0">No services found.</div>
                @endif
            </div>
        </div>
    </div>
</div>
