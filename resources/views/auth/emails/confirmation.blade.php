<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirm Your Email Address</title>
</head>
<body>
    <h1>Thanks for signing up!</h1>

    <p>
        We just need you to <a href='{{ action('Auth\AuthController@confirmation', $user->confirmation_token) }}'>confirm your email address</a> real quick!
    </p>
</body>
</html>