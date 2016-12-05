<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Application Approved</title>
</head>
<body>
    <p>Hi {{ $user->name }}, </p>
    <p>Your company {{ $vendor->name }} ({{$vendor->registration_number}}) application has been deleted.</p>
    <br>
    <p>If you or your company member did not make this change and believe your account has been compromised, please contact us.</p>
    <br>
    <p>Thank you.</p>
</body>
</html>