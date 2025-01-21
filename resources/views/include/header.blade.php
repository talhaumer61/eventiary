<!DOCTYPE html>
<html lang="zxx">
    
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--=== Bootstrap CSS ===-->
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
        <!-- Animate Min CSS -->
        <link rel="stylesheet" href="{{asset('css/animate.min.css')}}">
        <!--=== remixIcon CSS ===-->
        <link rel="stylesheet" href="{{asset('fonts/remixicon.css')}}">
        <!-- Owl Carousel Min CSS --> 
        <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
        <!--=== metisMenu Min CSS ===-->
        <link rel="stylesheet" href="{{asset('css/metismenu.min.css')}}">
        <!--=== simpleBar Min CSS ===--> 
        <link rel="stylesheet" href="{{asset('css/simplebar.min.css')}}">
        <!-- Dropzone CSS --> 
        <link rel="stylesheet" href="{{asset('css/dropzone.min.css')}}">
        <!-- Magnific Popup CSS --> 
        <link rel="stylesheet" href="{{asset('css/magnific-popup.min.css')}}">
        <!-- Odometer CSS -->
        <link rel="stylesheet" href="{{asset('css/odometer.min.css')}}">
        <!--=== meanMenu Min CSS ===-->
        <link rel="stylesheet" href="{{asset('css/meanmenu.min.css')}}">
        <!-- Style CSS -->
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <!-- Responsive CSS -->
        <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
        <!-- Theme Dark CSS -->
        {{-- <link rel="stylesheet" href="{{asset('css/theme-dark.css')}}"> --}}

        <!--=== Title & Favicon ===-->
        <title>{{ $page_title }}</title>
        <link rel="icon" type="image/png" href="{{asset('images/favicon.png')}}">
    </head>
    <body>
        <!-- Pre Loader -->

        {{-- <div class="preloader">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="spinner"></div>
                </div>
            </div>
        </div> --}}
        
        <!-- End Pre Loader -->

        @include('include.navbar')