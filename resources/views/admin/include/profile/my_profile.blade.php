<div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div>
        {{-- <h1 class="page-title fw-medium fs-18 mb-2">Profile</h1> --}}
        <div class="">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item active" aria-current="page">Home</li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Profile</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Header Close -->

<!-- Start::row-1 -->
<div class="row mb-5">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header d-sm-flex d-block">
                <ul class="nav nav-tabs nav-tabs-header mb-0 d-sm-flex d-block" role="tablist">
                    <li class="nav-item m-1">
                        <a class="nav-link active" data-bs-toggle="tab" role="tab" aria-current="page"
                        href="#personal-info" aria-selected="true">Personal Information</a>
                    </li>
                    <li class="nav-item m-1">
                        <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page"
                        href="#account-settings" aria-selected="true">Account Settings</a>
                    {{-- </li>
                    <li class="nav-item m-1">
                        <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page"
                        href="#email-settings" aria-selected="true">Email</a>
                    </li>
                    <li class="nav-item m-1">
                        <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page"
                        href="#labels" aria-selected="true">Labels</a>
                    </li>
                    <li class="nav-item m-1">
                        <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page"
                        href="#notification-settings" aria-selected="true">Notifications</a>
                    </li>
                    <li class="nav-item m-1">
                        <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page"
                        href="#security" aria-selected="true">Security</a>
                    </li> --}}
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane show active" id="personal-info" role="tabpanel">
                        <form action="{{ route('update.profile') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="p-sm-3 p-0">
                                <h6 class="fw-medium mb-3">
                                    Photo :
                                </h6>
                                <div class="mb-4 d-sm-flex align-items-center">
                                    <div class="mb-0 me-5">
                                        <span class="avatar avatar-xxl avatar-rounded">
                                            <img src="{{asset(''.$user->photo.'')}}" alt="" id="profile-img">
                                            <a href="javascript:void(0);" class="badge rounded-pill bg-primary avatar-badge">
                                                <input type="file" name="photo" class="position-absolute w-100 h-100 op-0" id="profile-change">
                                                <i class="fe fe-camera"></i>
                                            </a>
                                        </span>
                                    </div>
                                    {{-- <div class="btn-group">
                                        <button class="btn btn-primary">Change</button>
                                        <button class="btn btn-light">Remove</button>
                                    </div> --}}
                                </div>
                                <h6 class="fw-medium mb-3">
                                    Profile :
                                </h6>
                                <div class="row gy-4 mb-4">
                                    <div class="col-xl-6">
                                        <label for="first-name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="first-name" name="name" value="{{ $user->name }}" placeholder="Firt Name">
                                    </div>
                                    <div class="col-xl-6">
                                        <label for="last-name" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="last-name" name="username" value="{{ $user->username }}" placeholder="Last Name">
                                    </div> 
                                </div>
                                <h6 class="fw-medium mb-3">
                                    Personal information :
                                </h6>
                                <div class="row gy-4 mb-4">
                                    <div class="col-xl-6">
                                        <label for="email-address" class="form-label">Email Address :</label>
                                        <input type="text" class="form-control" id="email-address" name="email" value="{{ $user->email }}" readonly placeholder="xyz@gmail.com">
                                    </div>
                                    <div class="col-xl-6">
                                        <label for="Contact-Details" class="form-label">Phone :</label>
                                        <input type="text" class="form-control" id="Contact-Details" name="phone" value="{{ $user->phone }}" placeholder="contact details">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Update Profile</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="account-settings"
                        role="tabpanel">
                        <div class="row gap-3 justify-content-between">
                            <div class="col-xl-12">
                                <div class="card custom-card shadow-none mb-0 border">
                                    <div class="card-body">

                                        <form action="{{ route('change-password') }}" method="POST" id="changePasswordForm">
                                            @csrf
                                            <div class="d-flex align-items-top justify-content-between">
                                                <div class="w-100">
                                                    <p class="fs-14 mb-1 fw-medium">Reset Password</p>
                                                    <p class="fs-12 text-muted">
                                                        Password should be a minimum of <b class="text-success">8 characters</b>, 
                                                        at least <b class="text-success">one capital letter</b>, and 
                                                        <b class="text-success">one special character</b>.
                                                    </p>
                                        
                                                    <div class="mb-3">
                                                        <label for="current-password" class="form-label">Current Password</label>
                                                        <input type="password" class="form-control" id="current-password" name="current_password" placeholder="Current Password">
                                                        <span class="text-danger" id="currentPasswordError"></span>
                                                    </div>
                                        
                                                    <div class="mb-3">
                                                        <label for="new-password" class="form-label">New Password</label>
                                                        <input type="password" class="form-control" id="new-password" name="new_password" placeholder="New Password">
                                                        <span class="text-danger" id="newPasswordError"></span>
                                                    </div>
                                        
                                                    <div class="mb-3">
                                                        <label for="confirm-password" class="form-label">Confirm Password</label>
                                                        <input type="password" class="form-control" id="confirm-password" name="new_password_confirmation" placeholder="Confirm Password">
                                                        <span class="text-danger" id="confirmPasswordError"></span>
                                                    </div>
                                        
                                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                                </div>
                                            </div>
                                        </form>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>