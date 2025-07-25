<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card mt-4">
            <div class="card-body">
                <div class="contact-header">
                    <div class="d-sm-flex d-block align-items-center justify-content-between">
                        <div class="h5 fw-medium mb-0">Users</div>
                        {{-- <div class="d-flex mt-sm-0 mt-2 align-items-center">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0" placeholder="Search..." aria-describedby="search-contact-member">
                                <button class="btn btn-light" type="button" id="search-contact-member"><i class="ri-search-line text-muted"></i></button>
                            </div>
                            <div class="dropdown ms-2">
                                <button class="btn btn-icon btn-primary-light btn-wave" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="javascript:void(0);">Delete All</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">Copy All</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">Move To</a></li>
                                </ul>
                            </div>
                            <button class="btn btn-icon btn-secondary-light ms-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add Contact"><i class="ri-add-line"></i></button>
                        </div> --}}
                    </div>
                </div> 
            </div>
        </div>
    </div>
    @foreach($clients as $client)
        <div class="col-xxl-2 col-xl-3 col-lg-3 col-md-4 col-sm-6">
            <div class="card custom-card text-center">
                <div class="card-body p-4">
                    <div class="avatar avatar-xl avatar-rounded mb-3">
                        <img src="{{ $client->profile_photo ? asset('uploads/users/' . $client->profile_photo) : asset('dashboard/images/faces/4.jpg') }}"
                             alt="" class="img-thumbnail">
                    </div>
                    <div class="mb-3">
                        <h6 class="mb-1 fw-medium">{{ $client->name }}</h6>
                        <p class="mb-1 text-muted contact-mail text-truncate">{{ $client->email }}</p>
                        <p class="fw-medium fs-11 mb-0 text-primary">{{ $client->phone ?? 'N/A' }}</p>
                    </div>
                    {{-- <div class="d-flex align-items-center justify-content-center gap-2">
                        <a href="{{ route('admin.client.profile', $client->id) }}" class="btn btn-sm btn-outline-light border">
                            View Profile
                        </a>
                        <div class="dropdown">  
                            <button class="btn btn-sm btn-icon btn-outline-light btn-wave border" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ri-more-2-fill"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#"><i class="ri-share-line me-2"></i>Share</a></li>
                                <li><a class="dropdown-item" href="#"><i class="ri-phone-line me-2"></i>Call</a></li>
                                <li><a class="dropdown-item" href="#"><i class="ri-chat-2-line me-2"></i>Message</a></li>
                                <li><a class="dropdown-item" href="#"><i class="ri-video-chat-line me-2"></i>Video Call</a></li>
                                <li><a class="dropdown-item text-danger" href="#"><i class="ri-delete-bin-5-line me-2"></i>Delete</a></li>
                                <li><a class="dropdown-item" href="#"><i class="ri-heart-3-line me-2"></i>Favourite</a></li>
                            </ul>
                        </div>
                        <button aria-label="button" class="btn btn-sm btn-icon btn-outline-light border" type="button">
                            <i class="ri-heart-3-fill text-danger"></i>
                        </button>
                    </div> --}}
                </div>
            </div>
        </div>
    @endforeach
</div>