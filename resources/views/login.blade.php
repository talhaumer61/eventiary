<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-vertical-style="overlay" data-theme-mode="light" data-header-styles="light" data-menu-styles="light" data-toggled="close">

<head>

    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Login - Eventiary </title>
    <meta name="Description" content="">
	<meta name="keywords" content="">

    <!-- Favicon -->
    <link rel="icon" href="images/favicon.png" type="image/x-icon">

    <!-- Main Theme Js -->
    <script src="dashboard/js/authentication-main.js"></script>

    <!-- Bootstrap Css -->
    <link id="style" href="dashboard/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" >

    <!-- Style Css -->
    <link href="dashboard/css/styles.css" rel="stylesheet" >

    <!-- Icons Css -->
    <link href="dashboard/css/icons.css" rel="stylesheet" >

</head>

<body class="bg-white">


    <div class="row authentication mx-0">

        <div class="col-xxl-5 col-xl-5 col-lg-12">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-xxl-6 col-xl-9 col-lg-6 col-md-6 col-sm-8 col-12">
                    <div class="card custom-card shadow-none my-4">
                        <div class="card-body p-4">
                            {{-- <div class="mb-3 d-flex justify-content-center">
                                <a href="index.html">
                                    <img src="dashboard/images/brand-logos/desktop-logo.png" alt="logo" class="authentication-brand desktop-logo">
                                    <img src="dashboard/images/brand-logos/desktop-dark.png" alt="logo" class="authentication-brand desktop-dark">
                                </a>
                            </div> --}}
                            <p class="h5 mb-2 text-center">Sign In</p>
                            <p class="mb-4 text-muted op-7 fw-normal text-center">Welcome back Jhon !</p>
                            <form action="{{ route('clientLogin') }}" method="POST">
                                @csrf
                                <div class="row gy-3">
                                    <!-- Username Field -->
                                    <div class="col-xl-12">
                                        <label for="signin-username" class="form-label text-default">User Name</label>
                                        <input type="text" class="form-control form-control-lg @error('username') is-invalid @enderror" 
                                               name="username" id="signin-username" placeholder="user name" value="{{ old('username') }}">
                                        @error('username')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                            
                                    <!-- Password Field -->
                                    <div class="col-xl-12 mb-2">
                                        <label for="signin-password" class="form-label text-default d-block">Password
                                            <a href="#" class="float-end text-danger">Forget password ?</a>
                                        </label>
                                        <div class="position-relative">
                                            <input type="password" 
                                                   class="form-control form-control-lg @error('password') border border-danger @enderror"
                                                   name="password" id="signin-password" placeholder="password">
                                            <a href="javascript:void(0);" class="show-password-button text-muted" 
                                               onclick="createpassword('signin-password',this)" id="button-addon2">
                                                <i class="ri-eye-off-line align-middle"></i>
                                            </a>
                                        </div>
                                        @error('password')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            
                                <!-- General Error Message (if any) -->
                                @if (session('error'))
                                    <div class="alert alert-danger mt-2">
                                        {{ session('error') }}
                                    </div>
                                @endif
                            
                                <div class="d-grid mt-4">
                                    <button type="submit" class="btn btn-lg btn-primary">Sign In</button>
                                </div>
                            </form>                            
                            
                            <div class="text-center">
                                <p class="text-muted mt-3 mb-0">Dont have an account? <a href="/signup" class="text-primary">Sign Up</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-7 col-xl-7 col-lg-7 d-xl-block d-none px-0">
            <div class="authentication-cover bg-primary">
                <div>
                    <div class="authentication-cover-image">
                        <img src="dashboard/images/media/media-67.png" alt="">
                    </div>
                    <div class="text-center mb-4">
                        <h1 class="text-fixed-white">Sign In</h1>
                    </div>
                    <div class="btn-list text-center">
                        <a href="javascript:void(0);" class="btn btn-icon authentication-cover-icon btn-wave">
                            <i class="ri-facebook-line fw-bold"></i>
                        </a>
                        <a href="javascript:void(0);" class="btn btn-icon authentication-cover-icon btn-wave">
                            <i class="ri-twitter-line fw-bold"></i>
                        </a>
                        <a href="javascript:void(0);" class="btn btn-icon authentication-cover-icon btn-wave">
                            <i class="ri-instagram-line fw-bold"></i>
                        </a>
                        <a href="javascript:void(0);" class="btn btn-icon authentication-cover-icon btn-wave">
                            <i class="ri-github-line fw-bold"></i>
                        </a>
                        <a href="javascript:void(0);" class="btn btn-icon authentication-cover-icon btn-wave">
                            <i class="ri-youtube-line fw-bold"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="dashboard/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Swiper JS -->
    <script src="dashboard/libs/swiper/swiper-bundle.min.js"></script>

    <!-- Internal Authentication JS -->
    <script src="dashboard/js/authentication.js"></script>

    <!-- Show Password JS -->
    <script src="dashboard/js/show-password.js"></script>

</body>

</html>