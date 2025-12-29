<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Account Created</title>
</head>
<body>
    <h2>Hello {{ $user->name }},</h2>

    <p>Your account has been successfully created and verified.</p>

    <p><strong>Username:</strong> {{ $user->username }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>

    <p>You can now log in and start using the platform.</p>

    <p>Thank you,<br>
    {{ config('app.name') }}</p>
</body>
</html>
