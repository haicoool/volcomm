<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
</head>
<body>
<p>You are receiving this email because we received a password reset request for your account.</p>
<p>Click the link below to reset your password:</p>
<a href="{{ route('volunteer.password.reset', ['token' => $token]) }}">Reset Password</a>
<p>This link will expire in 10 minutes.</p>
<p>If you did not request a password reset, no further action is required.</p>
</body>
</html>
