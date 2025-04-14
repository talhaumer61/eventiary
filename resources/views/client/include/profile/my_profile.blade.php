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
                    {{-- <div class="tab-pane p-0" id="email-settings"
                        role="tabpanel">
                        <ul class="list-group list-group-flush rounded">
                            <li class="list-group-item">
                                <div class="row gy-2 d-sm-flex align-items-center justify-content-between">
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                                        <span class="fs-14 fw-medium mb-0">Menu View :</span>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Default View
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked="">
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                Advanced View
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xl-5">
                                        <div class="custom-toggle-switch float-sm-end"> 
                                            <input id="menu-view" name="toggleswitchsize" type="checkbox" checked=""> 
                                            <label for="menu-view" class="label-danger mb-1"></label>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row gy-3 d-sm-flex align-items-center justify-content-between">
                                    <div class="col-xl-3">
                                        <span class="fs-14 fw-medium mb-0">Language :</span>
                                    </div>
                                    <div class="col-xl-4">
                                        <label for="mail-language" class="form-label">Languages :</label>
                                        <select class="form-control" name="mail-language" id="mail-language" multiple>
                                        <option value="Choice 1" selected>English</option>
                                        <option value="Choice 2" selected>French</option>
                                        <option value="Choice 3">Arabic</option>
                                        <option value="Choice 4">Hindi</option>
                                        </select>
                                    </div>
                                    <div class="col-xl-5">
                                        <div class="custom-toggle-switch float-sm-end"> 
                                            <input id="mail-languages" name="toggleswitchsize" type="checkbox"> 
                                            <label for="mail-languages" class="label-danger mb-1"></label>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row gy-2 d-sm-flex align-items-center justify-content-between">
                                    <div class="col-xl-3">
                                        <span class="fs-14 fw-medium mb-0">Images :</span>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="images-open" id="images-open1">
                                            <label class="form-check-label" for="images-open1">
                                                Always Open Images
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="images-open" id="images-hide2" checked="">
                                            <label class="form-check-label" for="images-hide2">
                                                Ask For Permission
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xl-5">
                                        <div class="custom-toggle-switch float-sm-end"> 
                                            <input id="mails-images" name="toggleswitchsize" type="checkbox"> 
                                            <label for="mails-images" class="label-danger mb-1"></label>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row gy-2 d-sm-flex align-items-center justify-content-between">
                                    <div class="col-xl-3">
                                        <span class="fs-14 fw-medium mb-0">Keyboard Shortcuts :</span>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="keyboard-enable" id="keyboard-enable1">
                                            <label class="form-check-label" for="keyboard-enable1">
                                                Keyboard Shortcuts Enable
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="keyboard-enable" id="keyboard-disable2" checked="">
                                            <label class="form-check-label" for="keyboard-disable2">
                                                Keyboard Shortcuts Disable
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xl-5">
                                        <div class="custom-toggle-switch float-sm-end"> 
                                            <input id="keyboard-shortcuts" name="toggleswitchsize" type="checkbox"> 
                                            <label for="keyboard-shortcuts" class="label-danger mb-1"></label>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row gy-2 d-sm-flex align-items-center justify-content-between">
                                    <div class="col-xl-3">
                                        <span class="fs-14 fw-medium mb-0">Notifications :</span>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="desktop-notifications" checked="">
                                            <label class="form-check-label" for="desktop-notifications">
                                                Desktop Notifications
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="mobile-notifications">
                                            <label class="form-check-label" for="mobile-notifications">
                                                Mobile Notifications
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xl-5">
                                        <div class="float-sm-end">
                                            <a href="javascript:void(0)" class="btn btn-success-ghost btn-sm">Learn-more</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row gy-3 d-sm-flex align-items-center justify-content-between">
                                    <div class="col-xl-3">
                                        <span class="fs-14 fw-medium mb-0">Maximum Mails Per Page :</span>
                                    </div>
                                    <div class="col-xl-4">
                                        <select class="form-control" data-trigger name="mail-per-page" id="mail-per-page">
                                        <option value="Choice 1" selected>10</option>
                                        <option value="Choice 2">50</option>
                                        <option value="Choice 3">100</option>
                                        <option value="Choice 3">120</option>
                                        </select>
                                    </div>
                                    <div class="col-xl-5">
                                        <div class="custom-toggle-switch float-sm-end"> 
                                            <input id="mails-per-page" name="toggleswitchsize" type="checkbox"> 
                                            <label for="mails-per-page" class="label-danger mb-1"></label>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row gy-2 d-sm-flex align-items-center justify-content-between">
                                    <div class="col-xl-3">
                                        <span class="fs-14 fw-medium mb-0">Mail Composer :</span>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="mail-composer" id="mail-composeron1">
                                            <label class="form-check-label" for="mail-composeron1">
                                                Mail Composer On
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="mail-composer" id="mail-composeroff2" checked="">
                                            <label class="form-check-label" for="mail-composeroff2">
                                                Mail Composer Off
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xl-5">
                                        <div class="custom-toggle-switch float-sm-end"> 
                                            <input id="mail-composer" name="toggleswitchsize" type="checkbox"> 
                                            <label for="mail-composer" class="label-danger mb-1"></label>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row gy-2 d-sm-flex align-items-center justify-content-between">
                                    <div class="col-xl-3">
                                        <span class="fs-14 fw-medium mb-0">Auto Correct :</span>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="auto-correct" id="auto-correcton1">
                                            <label class="form-check-label" for="auto-correcton1">
                                                Auto Correct On
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="auto-correct" id="auto-correctoff2" checked="">
                                            <label class="form-check-label" for="auto-correctoff2">
                                                Auto Correct Off
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xl-5">
                                        <div class="custom-toggle-switch float-sm-end"> 
                                            <input id="auto-correct" name="toggleswitchsize" type="checkbox"> 
                                            <label for="auto-correct" class="label-danger mb-1"></label>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row gy-2 d-sm-flex align-items-center justify-content-between">
                                    <div class="col-xl-3">
                                        <span class="fs-14 fw-medium mb-0">Mail Send Action :</span>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="on-keyboard" checked="">
                                            <label class="form-check-label" for="on-keyboard">
                                                On Keyboard Action
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="on-buttonclick">
                                            <label class="form-check-label" for="on-buttonclick">
                                                On Button Click
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xl-5">
                                        <div class="float-sm-end">
                                            <a href="javascript:void(0)" class="btn btn-success-ghost btn-sm">Learn-more</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane" id="labels"
                        role="tabpanel">
                        <p class="fs-14 fw-medium mb-3">Mail Labels :</p>
                        <div class="row gy-2">
                            <div class="col-xl-3">
                                <div class="card custom-card shadow-none border">
                                    <div class="card-body d-flex align-items-center justify-content-between flex-wrap gap-2">
                                        <div class="">
                                            <span class="fw-medium">All Mails</span>
                                        </div>
                                        <div>
                                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                <input type="radio" class="btn-check" name="label-allmails" id="all-mails-enable" checked="">
                                                <label class="btn btn-sm btn-outline-primary" for="all-mails-enable">Enable</label>
                                                <input type="radio" class="btn-check" name="label-allmails" id="all-mails-disable">
                                                <label class="btn btn-sm btn-outline-primary" for="all-mails-disable">Disable</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="card custom-card shadow-none border">
                                    <div class="card-body d-flex align-items-center justify-content-between flex-wrap gap-2">
                                        <div class="">
                                            <span class="fw-medium">Inbox</span>
                                        </div>
                                        <div>
                                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                <input type="radio" class="btn-check" name="label-inbox" id="inbox-enable" checked="">
                                                <label class="btn btn-sm btn-outline-primary" for="inbox-enable">Enable</label>
                                                <input type="radio" class="btn-check" name="label-inbox" id="inbox-disable">
                                                <label class="btn btn-sm btn-outline-primary" for="inbox-disable">Disable</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="card custom-card shadow-none border">
                                    <div class="card-body d-flex align-items-center justify-content-between flex-wrap gap-2">
                                        <div class="">
                                            <span class="fw-medium">Sent</span>
                                        </div>
                                        <div>
                                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                <input type="radio" class="btn-check" name="label-sent" id="sent-enable" checked="">
                                                <label class="btn btn-sm btn-outline-primary" for="sent-enable">Enable</label>
                                                <input type="radio" class="btn-check" name="label-sent" id="sent-disable">
                                                <label class="btn btn-sm btn-outline-primary" for="sent-disable">Disable</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="card custom-card shadow-none border">
                                    <div class="card-body d-flex align-items-center justify-content-between flex-wrap gap-2">
                                        <div class="">
                                            <span class="fw-medium">Drafts</span>
                                        </div>
                                        <div>
                                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                <input type="radio" class="btn-check" name="label-drafts" id="drafts-enable" checked="">
                                                <label class="btn btn-sm btn-outline-primary" for="drafts-enable">Enable</label>
                                                <input type="radio" class="btn-check" name="label-drafts" id="drafts-disable">
                                                <label class="btn btn-sm btn-outline-primary" for="drafts-disable">Disable</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="card custom-card shadow-none border">
                                    <div class="card-body d-flex align-items-center justify-content-between flex-wrap gap-2">
                                        <div class="">
                                            <span class="fw-medium">Spam</span>
                                        </div>
                                        <div>
                                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                <input type="radio" class="btn-check" name="label-spam" id="spam-enable" checked="">
                                                <label class="btn btn-sm btn-outline-primary" for="spam-enable">Enable</label>
                                                <input type="radio" class="btn-check" name="label-spam" id="spam-disable">
                                                <label class="btn btn-sm btn-outline-primary" for="spam-disable">Disable</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="card custom-card shadow-none border">
                                    <div class="card-body d-flex align-items-center justify-content-between flex-wrap gap-2">
                                        <div class="">
                                            <span class="fw-medium">Important</span>
                                        </div>
                                        <div>
                                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                <input type="radio" class="btn-check" name="label-important" id="important-enable" checked="">
                                                <label class="btn btn-sm btn-outline-primary" for="important-enable">Enable</label>
                                                <input type="radio" class="btn-check" name="label-important" id="important-disable">
                                                <label class="btn btn-sm btn-outline-primary" for="important-disable">Disable</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="card custom-card shadow-none border">
                                    <div class="card-body d-flex align-items-center justify-content-between flex-wrap gap-2">
                                        <div class="">
                                            <span class="fw-medium">Trash</span>
                                        </div>
                                        <div>
                                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                <input type="radio" class="btn-check" name="label-trash" id="trash-enable" checked="">
                                                <label class="btn btn-sm btn-outline-primary" for="trash-enable">Enable</label>
                                                <input type="radio" class="btn-check" name="label-trash" id="trash-disable">
                                                <label class="btn btn-sm btn-outline-primary" for="trash-disable">Disable</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="card custom-card shadow-none border">
                                    <div class="card-body d-flex align-items-center justify-content-between flex-wrap gap-2">
                                        <div class="">
                                            <span class="fw-medium">Archive</span>
                                        </div>
                                        <div>
                                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                <input type="radio" class="btn-check" name="label-archive" id="archive-enable" checked="">
                                                <label class="btn btn-sm btn-outline-primary" for="archive-enable">Enable</label>
                                                <input type="radio" class="btn-check" name="label-archive" id="archive-disable">
                                                <label class="btn btn-sm btn-outline-primary" for="archive-disable">Disable</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="card custom-card shadow-none border">
                                    <div class="card-body d-flex align-items-center justify-content-between flex-wrap gap-2">
                                        <div class="">
                                            <span class="fw-medium">Starred</span>
                                        </div>
                                        <div>
                                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                <input type="radio" class="btn-check" name="label-starred" id="starred-enable" checked="">
                                                <label class="btn btn-sm btn-outline-primary" for="starred-enable">Enable</label>
                                                <input type="radio" class="btn-check" name="label-starred" id="starred-disable">
                                                <label class="btn btn-sm btn-outline-primary" for="starred-disable">Disable</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="fs-14 fw-medium mb-3">Settings :</p>
                        <div class="row gy-2">
                            <div class="col-xl-3">
                                <div class="card custom-card shadow-none border">
                                    <div class="card-body d-flex align-items-center justify-content-between flex-wrap gap-2">
                                        <div class="">
                                            <span class="fw-medium">Settings</span>
                                        </div>
                                        <div>
                                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                <input type="radio" class="btn-check" name="label-settings" id="settings-enable" checked="">
                                                <label class="btn btn-sm btn-outline-primary" for="settings-enable">Enable</label>
                                                <input type="radio" class="btn-check" name="label-settings" id="settings-disable">
                                                <label class="btn btn-sm btn-outline-primary" for="settings-disable">Disable</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>    
                        <p class="fs-14 fw-medium mb-3">Custom Labels :</p>
                        <div class="row gy-2">
                            <div class="col-xl-3">
                                <div class="card custom-card shadow-none border">
                                    <div class="card-body d-flex align-items-center justify-content-between flex-wrap gap-2">
                                        <div class="">
                                            <span class="fw-medium">Mail</span>
                                        </div>
                                        <div>
                                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                <input type="radio" class="btn-check" name="label-custom-mail" id="custom-mail-enable" checked="">
                                                <label class="btn btn-sm btn-outline-primary" for="custom-mail-enable">Enable</label>
                                                <input type="radio" class="btn-check" name="label-custom-mail" id="custom-mail-disable">
                                                <label class="btn btn-sm btn-outline-primary" for="custom-mail-disable">Disable</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="card custom-card shadow-none border">
                                    <div class="card-body d-flex align-items-center justify-content-between flex-wrap gap-2">
                                        <div class="">
                                            <span class="fw-medium">Home</span>
                                        </div>
                                        <div>
                                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                <input type="radio" class="btn-check" name="label-home" id="home-enable" checked="">
                                                <label class="btn btn-sm btn-outline-primary" for="home-enable">Enable</label>
                                                <input type="radio" class="btn-check" name="label-home" id="home-disable">
                                                <label class="btn btn-sm btn-outline-primary" for="home-disable">Disable</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="card custom-card shadow-none border">
                                    <div class="card-body d-flex align-items-center justify-content-between flex-wrap gap-2">
                                        <div class="">
                                            <span class="fw-medium">Work</span>
                                        </div>
                                        <div>
                                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                <input type="radio" class="btn-check" name="label-work" id="work-enable" checked="">
                                                <label class="btn btn-sm btn-outline-primary" for="work-enable">Enable</label>
                                                <input type="radio" class="btn-check" name="label-work" id="work-disable">
                                                <label class="btn btn-sm btn-outline-primary" for="work-disable">Disable</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="card custom-card shadow-none border">
                                    <div class="card-body d-flex align-items-center justify-content-between flex-wrap gap-2">
                                        <div class="">
                                            <span class="fw-medium">Friends</span>
                                        </div>
                                        <div>
                                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                <input type="radio" class="btn-check" name="label-friends" id="friends-enable" checked="">
                                                <label class="btn btn-sm btn-outline-primary" for="friends-enable">Enable</label>
                                                <input type="radio" class="btn-check" name="label-friends" id="friends-disable">
                                                <label class="btn btn-sm btn-outline-primary" for="friends-disable">Disable</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>    
                    </div>
                    <div class="tab-pane p-0" id="notification-settings"
                        role="tabpanel">
                        <ul class="list-group list-group-flush list-unstyled rounded">
                            <li class="list-group-item">
                                <div class="row gx-5 gy-3">
                                    <div class="col-xl-5">
                                        <p class="fs-16 mb-1 fw-medium">Email Notifications</p>
                                        <p class="fs-12 mb-0 text-muted">Email notifications are the notifications you will receeive when you are offline, you can customize them by enabling or disabling them.</p>
                                    </div>
                                    <div class="col-xl-7">
                                        <div class="d-flex align-items-top justify-content-between mt-sm-0 mt-3">
                                            <div class="mail-notification-settings">
                                                <p class="fs-14 mb-1 fw-medium">Updates & Features</p>
                                                <p class="fs-12 mb-0 text-muted">Notifications about new updates and their features.</p>
                                            </div>
                                            <div>
                                                <div class="custom-toggle-switch float-sm-end"> 
                                                    <input id="update-features" name="toggleswitchsize" type="checkbox" checked=""> 
                                                    <label for="update-features" class="label-success mb-1"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-top justify-content-between mt-3">
                                            <div class="mail-notification-settings">
                                                <p class="fs-14 mb-1 fw-medium">Early Access</p>
                                                <p class="fs-12 mb-0 text-muted">Users are selected for beta testing of new update,notifications relating or participate in any of paid product promotion.</p>
                                            </div>
                                            <div>
                                                <div class="custom-toggle-switch float-sm-end"> 
                                                    <input id="early-access" name="toggleswitchsize" type="checkbox"> 
                                                    <label for="early-access" class="label-success mb-1"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-top justify-content-between mt-3">
                                            <div class="mail-notification-settings">
                                                <p class="fs-14 mb-1 fw-medium">Email Shortcuts</p>
                                                <p class="fs-12 mb-0 text-muted">Shortcut notifications for email.</p>
                                            </div>
                                            <div>
                                                <div class="custom-toggle-switch float-sm-end"> 
                                                    <input id="email-shortcut" name="toggleswitchsize" type="checkbox" checked=""> 
                                                    <label for="email-shortcut" class="label-success mb-1"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-top justify-content-between mt-3">
                                            <div class="mail-notification-settings">
                                                <p class="fs-14 mb-1 fw-medium">New Mails</p>
                                                <p class="fs-12 mb-0 text-muted">Notifications related to new mails received.</p>
                                            </div>
                                            <div>
                                                <div class="custom-toggle-switch float-sm-end"> 
                                                    <input id="new-mails" name="toggleswitchsize" type="checkbox" checked=""> 
                                                    <label for="new-mails" class="label-success mb-1"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-top justify-content-between mt-3">
                                            <div class="mail-notification-settings">
                                                <p class="fs-14 mb-1 fw-medium">Mail Chat Messages</p>
                                                <p class="fs-12 mb-0 text-muted">Any of new messages are received will be updated through notifications.</p>
                                            </div>
                                            <div>
                                                <div class="custom-toggle-switch float-sm-end"> 
                                                    <input id="mail-chat-messages" name="toggleswitchsize" type="checkbox" checked=""> 
                                                    <label for="mail-chat-messages" class="label-success mb-1"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row gx-5 gy-3">
                                    <div class="col-xl-5">
                                        <p class="fs-16 mb-1 fw-medium">Push Notifications</p>
                                        <p class="fs-12 mb-0 text-muted">Push notifications are recieved when you are online, you can customize them by enabling or disabling them.</p>
                                    </div>
                                    <div class="col-xl-7">
                                        <div class="d-flex align-items-top justify-content-between mt-sm-0 mt-3">
                                            <div class="mail-notification-settings">
                                                <p class="fs-14 mb-1 fw-medium">New Mails</p>
                                                <p class="fs-12 mb-0 text-muted">Notifications related to new mails received.</p>
                                            </div>
                                            <div>
                                                <div class="custom-toggle-switch float-sm-end"> 
                                                    <input id="push-new-mails" name="toggleswitchsize" type="checkbox" checked=""> 
                                                    <label for="push-new-mails" class="label-success mb-1"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-top justify-content-between mt-3">
                                            <div class="mail-notification-settings">
                                                <p class="fs-14 mb-1 fw-medium">Mail Chat Messages</p>
                                                <p class="fs-12 mb-0 text-muted">Any of new messages are received will be updated through notifications.</p>
                                            </div>
                                            <div>
                                                <div class="custom-toggle-switch float-sm-end"> 
                                                    <input id="push-mail-chat-messages" name="toggleswitchsize" type="checkbox" checked=""> 
                                                    <label for="push-mail-chat-messages" class="label-success mb-1"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-top justify-content-between mt-3">
                                            <div class="mail-notification-settings">
                                                <p class="fs-14 mb-1 fw-medium">Mail Extensions</p>
                                                <p class="fs-12 mb-0 text-muted">Notifications related to the extensions received by new emails and thier propertied also been displayed.</p>
                                            </div>
                                            <div>
                                                <div class="custom-toggle-switch float-sm-end"> 
                                                    <input id="mail-extensions" name="toggleswitchsize" type="checkbox"> 
                                                    <label for="mail-extensions" class="label-success mb-1"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane p-0" id="security"
                        role="tabpanel">
                        <ul class="list-group list-group-flush list-unstyled rounded">
                            <li class="list-group-item">
                                <div class="row gx-5 gy-3">
                                    <div class="col-xl-4">
                                        <p class="fs-16 mb-1 fw-medium">Logging In</p>
                                        <p class="fs-12 mb-0 text-muted">Security settings related to logging into our email account and taking down account if any mischevious action happended.</p>
                                    </div>
                                    <div class="col-xl-8">
                                        <div class="d-sm-flex d-block align-items-top justify-content-between mt-sm-0 mt-3">
                                            <div class="mail-security-settings">
                                                <p class="fs-14 mb-1 fw-medium">Max Limit for login attempts</p>
                                                <p class="fs-12 mb-0 text-muted">Account will freeze for 24hrs while attempt to login with wrong credentials for selected number of times</p>
                                            </div>
                                            <div>
                                                <select class="form-control" data-trigger name="max-login-attempts" id="max-login-attempts">
                                                <option value="Choice 1" selected>3 Attempts</option>
                                                <option value="Choice 2">5 Attempts</option>
                                                <option value="Choice 3">10 Attempts</option>
                                                <option value="Choice 3">20 Attempts</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="d-sm-flex d-block align-items-top justify-content-between mt-3">
                                            <div>
                                                <p class="fs-14 mb-1 fw-medium">Account Freeze time management</p>
                                                <p class="fs-12 mb-0 text-muted">You can change the time for the account freeze when attempts for </p>
                                            </div>
                                            <div>
                                                <select class="form-control" data-trigger name="account-freeze-time-format" id="account-freeze-time-format">
                                                <option value="Choice 1" selected>1 Day</option>
                                                <option value="Choice 2">1 Hour</option>
                                                <option value="Choice 3">1 Month</option>
                                                <option value="Choice 3">1 Year</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row gx-5 gy-3">
                                    <div class="col-xl-4">
                                        <p class="fs-16 mb-1 fw-medium">Password Requirements</p>
                                        <p class="fs-12 mb-0 text-muted">Security settings related to password strength.</p>
                                    </div>
                                    <div class="col-xl-8">
                                        <div class="d-sm-flex d-block align-items-top justify-content-between mt-sm-0 mt-3 gap-3">
                                            <div class="mail-security-settings">
                                                <p class="fs-14 mb-1 fw-medium">Minimum number of characters in the password</p>
                                                <p class="fs-12 mb-0 text-muted">There should be a minimum number of characters for a password to be validated that shouls be set here.</p>
                                            </div>
                                            <div>
                                                <input type="text" class="form-control" value="8">
                                            </div>
                                        </div>
                                        <div class="d-sm-flex d-block align-items-top justify-content-between mt-3">
                                            <div>
                                                <p class="fs-14 mb-1 fw-medium">Contain A Number</p>
                                                <p class="fs-12 mb-0 text-muted">Password should contain a number.</p>
                                            </div>
                                            <div>
                                                <div class="custom-toggle-switch float-sm-end"> 
                                                    <input id="password-number" name="toggleswitchsize" type="checkbox"> 
                                                    <label for="password-number" class="label-success mb-1"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-sm-flex d-block align-items-top justify-content-between mt-3">
                                            <div>
                                                <p class="fs-14 mb-1 fw-medium">Contain A Special Character</p>
                                                <p class="fs-12 mb-0 text-muted">Password should contain a special Character.</p>
                                            </div>
                                            <div>
                                                <div class="custom-toggle-switch float-sm-end"> 
                                                    <input id="password-special-character" name="toggleswitchsize" type="checkbox" checked=""> 
                                                    <label for="password-special-character" class="label-success mb-1"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-sm-flex d-block align-items-top justify-content-between mt-3">
                                            <div>
                                                <p class="fs-14 mb-1 fw-medium">Atleast One Capital Letter</p>
                                                <p class="fs-12 mb-0 text-muted">Password should contain atleast one capital letter.</p>
                                            </div>
                                            <div>
                                                <div class="custom-toggle-switch float-sm-end"> 
                                                    <input id="password-capital" name="toggleswitchsize" type="checkbox" checked=""> 
                                                    <label for="password-capital" class="label-success mb-1"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-sm-flex d-block align-items-top justify-content-between mt-3">
                                            <div>
                                                <p class="fs-14 mb-1 fw-medium">Maximum Password Length</p>
                                                <p class="fs-12 mb-0 text-muted">Maximum password lenth should be selected here.</p>
                                            </div>
                                            <div>
                                                <input type="text" class="form-control" value="16">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row gx-5 gy-3">
                                    <div class="col-xl-4">
                                        <p class="fs-16 mb-1 fw-medium">Unknown Chats</p>
                                        <p class="fs-12 mb-0 text-muted">Security settings related to unknown chats.</p>
                                    </div>
                                    <div class="col-xl-8">
                                        <div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="unknown-messages" id="unknown-messages-show1">
                                                <label class="form-check-label" for="unknown-messages-show1">
                                                    Show
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="unknown-messages" id="unknown-messages-hide2" checked="">
                                                <label class="form-check-label" for="unknown-messages-hide2">
                                                    Hide
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>    
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById("profile-change").addEventListener("change", function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById("profile-img").src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
