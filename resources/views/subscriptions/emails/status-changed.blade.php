<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <p>Dear {{ $user['name'] }}</p>
    <p>Your subscriptions status has been changed to <strong>{{ ucwords($status) }}</strong>.</p>
</body>
</html>