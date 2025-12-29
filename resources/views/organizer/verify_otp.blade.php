<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify OTP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon icon -->
    <link rel="shortcut icon" href="{{asset('images/favicon.png')}}" media="all">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #9109b7, #dc26c7);
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
        }

        .otp-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .otp-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 15px 40px rgba(0,0,0,.15);
            width: 100%;
            max-width: 420px;
            padding: 35px;
            text-align: center;
        }

        .otp-card h3 {
            font-weight: 700;
            color: #b315bd;
            margin-bottom: 10px;
        }

        .otp-card p {
            font-size: 14px;
            color: #666;
            margin-bottom: 25px;
        }

        .otp-input {
            letter-spacing: 8px;
            text-align: center;
            font-size: 22px;
            height: 55px;
            border-radius: 12px;
        }

        .otp-input:focus {
            border-color: #c953d2;
            box-shadow: 0 0 0 .2rem rgba(220,38,38,.15);
        }

        .main-btn-red {
            background: #c953d2;
            border: none;
            border-radius: 12px;
            height: 50px;
            color: #fff;
            font-weight: 600;
            transition: 0.3s;
            width: 100%;
        }

        .main-btn-red:hover {
            background: #b91c1c;
        }

        .resend {
            font-size: 14px;
            margin-top: 15px;
        }

        .resend a {
            color: #dc2626;
            font-weight: 600;
            text-decoration: none;
        }

        .resend a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="otp-wrapper">
    <div class="otp-card">

        <i class="fas fa-shield-alt fa-3x text-danger mb-3"></i>

        <h3>Verify OTP</h3>
        <p>
            We’ve sent a 6-digit verification code to your email.
            Please enter it below to continue.
        </p>

        {{-- Success / Error Messages --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ url('/organizer-verify-otp') }}">
            @csrf

            <div class="mb-4">
                <input type="text"
                       name="otp"
                       class="form-control otp-input"
                       placeholder="------"
                       maxlength="6"
                       required>
            </div>

            <button type="submit" class="main-btn-red">
                Verify OTP
            </button>
        </form>

        <div class="resend">
            Didn’t receive the code?
            <a href="{{ url('/organizer-resend-otp') }}">Resend OTP</a>
        </div>

    </div>
</div>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
