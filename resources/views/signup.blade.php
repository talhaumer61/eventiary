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

<body class="authentication-background">


    <div class="container-lg">
        <div class="row justify-content-center align-items-center authentication authentication-basic h-100">
            <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-6 col-sm-8 col-12">
                <div class="card custom-card my-4">
                    <div class="card-body p-5">
                        <p class="h5 mb-2 text-center">Sign Up</p>
                        <p class="mb-4 text-muted op-7 fw-normal text-center">Welcome & Join us by creating a free account !</p>
                        
                        <form action=" {{ route('clientSignup') }} " method="post" onsubmit="return validateSignupForm()">
                            @csrf
                            <div class="row gy-3">
                                <div class="col-xl-12">
                                    <label for="signup-firstname" class="form-label text-default">Full Name<sup>*</sup></label>
                                    <input type="text" class="form-control form-control-lg" name="name" id="signup-firstname" placeholder="full name">
                                    <small class="text-danger d-none" id="name-error"></small>
                                </div>
                                <div class="col-xl-12">
                                    <label for="signup-email" class="form-label text-default">Email<sup>*</sup></label>
                                    <input type="text" class="form-control form-control-lg" name="email" id="signup-email" placeholder="email">
                                    <small class="text-danger d-none" id="email-error"></small>
                                </div>
                                <div class="col-xl-12">
                                    <label for="signup-username" class="form-label text-default">Username<sup>*</sup></label>
                                    <input type="text" class="form-control form-control-lg" name="username" id="signup-username" placeholder="username">
                                    <small class="text-danger d-none" id="username-error"></small>
                                </div>
                                <div class="col-xl-12">
                                    <label for="signup-password" class="form-label text-default">Password<sup>*</sup></label>
                                    <div class="position-relative">
                                        <input type="password" class="form-control form-control-lg" name="password" id="signup-password" placeholder="password">
                                        <a href="javascript:void(0);" class="show-password-button text-muted" onclick="createpassword('signup-password',this)" id="button-addon2">
                                            <i class="ri-eye-off-line align-middle"></i>
                                        </a>
                                    </div>
                                    <small class="text-danger d-none" id="password-error"></small>
                                </div>
                                <div class="col-xl-12 mb-2">
                                    <label for="signup-confirmpassword" class="form-label text-default">Confirm Password<sup>*</sup></label>
                                    <div class="position-relative">
                                        <input type="password" class="form-control form-control-lg" name="password_confirmation" id="signup-confirmpassword" placeholder="confirm password">
                                        <a href="javascript:void(0);" class="show-password-button text-muted" onclick="createpassword('signup-confirmpassword',this)" id="button-addon21">
                                            <i class="ri-eye-off-line align-middle"></i>
                                        </a>
                                    </div>
                                    <small class="text-danger d-none" id="confirm-password-error"></small>
                                </div>
                            </div>
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-lg btn-primary">Create Account</button>
                            </div>
                        </form>
                        
                        <div class="text-center">
                            <p class="text-muted mt-3 mb-0">Already have an account? <a href="/login" class="text-primary">Sign In</a></p>
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
    <script>
        function validateSignupForm() {
            let isValid = true;
    
            // Get field values
            const name = document.getElementById('signup-firstname').value.trim();
            const email = document.getElementById('signup-email').value.trim();
            const username = document.getElementById('signup-username').value.trim();
            const password = document.getElementById('signup-password').value.trim();
            const confirmPassword = document.getElementById('signup-confirmpassword').value.trim();
    
            // Clear previous errors
            clearErrors();
    
            // Validate Name
            if (name === '') {
                showError('name-error', 'Full Name is required.');
                isValid = false;
            }
    
            // Validate Email
            if (email === '') {
                showError('email-error', 'Email is required.');
                isValid = false;
            } else if (!/^\S+@\S+\.\S+$/.test(email)) {
                showError('email-error', 'Invalid email format.');
                isValid = false;
            }
    
            // Validate Username
            if (username === '') {
                showError('username-error', 'Username is required.');
                isValid = false;
            }
    
            // Validate Password
            if (password === '') {
                showError('password-error', 'Password is required.');
                isValid = false;
            } else if (password.length < 8) {
                showError('password-error', 'Password must be at least 8 characters long.');
                isValid = false;
            }
    
            // Validate Confirm Password
            if (confirmPassword === '') {
                showError('confirm-password-error', 'Confirm Password is required.');
                isValid = false;
            } else if (password !== confirmPassword) {
                showError('confirm-password-error', 'Passwords do not match.');
                isValid = false;
            }
    
            return isValid;
        }
    
        function showError(elementId, message) {
            const errorElement = document.getElementById(elementId);
            errorElement.textContent = message;
            errorElement.classList.remove('d-none');
        }
    
        function clearErrors() {
            const errorElements = document.querySelectorAll('.text-danger');
            errorElements.forEach((element) => {
                element.textContent = '';
                element.classList.add('d-none');
            });
        }
    </script>
    

</body>


</html>