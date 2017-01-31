<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Application Approved</title>
</head>
<body>
    <h2>Congratulations!</h2>
    <p>Your company {{ $vendor->name }} ({{$vendor->registration_number}}) application has been approved.
    <br>
    <p> Login <a href='{{ route('contact') }}'>here</a> for more information. </p>
    <br>
    <p>Thank you.</p>
</body>
</html>