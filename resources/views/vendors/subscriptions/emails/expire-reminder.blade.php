<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <p>Dear {{ $user['name'] }}</p>
    <p>Your subscriptions status will be expired in <strong>{{ ucwords($days) }}</strong> days.</p>
</body>
</html>