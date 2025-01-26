<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-vertical-style="overlay" data-theme-mode="light" data-header-styles="light" data-menu-styles="light" data-toggled="close">


<head>

    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Sign Up - Eventiary </title>
    <meta name="Description" content="">
	<meta name="keywords" content="">

    <!-- Favicon -->
    <link rel="icon" href="https://spruko.com/demo/udon/dist/assets/images/brand-logos/favicon.ico" type="image/x-icon">

    <!-- Main Theme Js -->
    <script src="dashboard/js/authentication-main.js"></script>

    <!-- Bootstrap Css -->
    <link id="style" href="dashboard/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" >

    <!-- Style Css -->
    <link href="dashboard/css/styles.css" rel="stylesheet" >

    <!-- Icons Css -->
    <link href="dashboard/css/icons.css" rel="stylesheet" >


</head>

<body class="authentication-background">


    <div class="container-lg">
        <div class="row justify-content-center align-items-center authentication authentication-basic h-100">
            <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-6 col-sm-8 col-12">
                <div class="card custom-card my-4">
                    <div class="card-body p-5">
                        {{-- <div class="mb-3 d-flex justify-content-center">
                            <a href="index.html">
                                <img src="dashboard/images/brand-logos/desktop-logo.png" alt="logo" class="desktop-logo">
                                <img src="dashboard/images/brand-logos/desktop-dark.png" alt="logo" class="desktop-dark">
                            </a>
                        </div> --}}
                        <p class="h5 mb-2 text-center">Sign Up</p>
                        <p class="mb-4 text-muted op-7 fw-normal text-center">Welcome & Join us by creating a free account !</p>
                        <div class="row gy-3">
                            <div class="col-xl-12">
                                <label for="signup-firstname" class="form-label text-default">Full Name<sup>*</sup></label>
                                <input type="text" class="form-control form-control-lg" id="signup-firstname" placeholder="full name">
                            </div>
                            <div class="col-xl-12">
                                <label for="signup-password" class="form-label text-default">Password<sup>*</sup></label>
                                <div class="position-relative">
                                    <input type="password" class="form-control form-control-lg" id="signup-password" placeholder="password">
                                    <a href="javascript:void(0);" class="show-password-button text-muted" onclick="createpassword('signup-password',this)"  id="button-addon2"><i class="ri-eye-off-line align-middle"></i></a>
                                </div>
                            </div>
                            <div class="col-xl-12 mb-2">
                                <label for="signup-confirmpassword" class="form-label text-default">Confirm Password<sup>*</sup></label>
                                <div class="position-relative">
                                    <input type="password" class="form-control form-control-lg" id="signup-confirmpassword" placeholder="confirm password">
                                    <a href="javascript:void(0);" class="show-password-button text-muted" onclick="createpassword('signup-confirmpassword',this)"  id="button-addon21"><i class="ri-eye-off-line align-middle"></i></a>
                                </div>
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                    <label class="form-check-label text-muted fw-normal" for="defaultCheck1">
                                        By creating a account you agree to our <a href="terms_conditions.html" class="text-success"><u>Terms & Conditions</u></a> and <a class="text-success"><u>Privacy Policy</u></a>
                                    </label>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="text-center my-3 authentication-barrier">
                            <span>OR</span>
                        </div>
                        <div class="d-grid mb-3">
                            <button class="btn btn-lg btn-light-ghost border d-flex align-items-center justify-content-center">
                                <span class="avatar avatar-xs">
                                    <img src="dashboard/images/media/apps/google.png" alt="">
                                </span>
                                <span class="lh-1 ms-2 fs-13 text-default">Signup with Google</span>
                            </button>
                        </div>
                        <div class="d-grid mb-3">
                            <button class="btn btn-lg btn-light-ghost border d-flex align-items-center justify-content-center">
                                <span class="avatar avatar-xs invert-1">
                                    <img src="dashboard/images/media/apps/apple.png" alt="">
                                </span>
                                <span class="lh-1 ms-2 fs-13 text-default">Signup with Apple</span>
                            </button>
                        </div> --}}
                        <div class="d-grid mt-4">
                            <button class="btn btn-lg btn-primary">Create Account</button>
                        </div>
                        <div class="text-center">
                            <p class="text-muted mt-3 mb-0">Already have an account? <a href="sign-in-basic.html" class="text-primary">Sign In</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="dashboard/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Show Password JS -->
    <script src="dashboard/js/show-password.js"></script>

</body>


</html>