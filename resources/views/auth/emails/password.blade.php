<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Password Reset Link</title>
</head>
<body>
    <h1>Reset Your Password!</h1>

    <p>
    	Click <a href="{{ url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}">here</a> to reset your password.
    </p>
</body>
</html>