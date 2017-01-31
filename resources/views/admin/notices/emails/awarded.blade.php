<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Notice Award</title>
</head>
<body>
    <h2>Congratulations!</h2>
    <p>Your company {{ $vendor->name }} ({{$vendor->registration_number}}) has been awarded for notice {{ $notice->name }} ({{ $notice->number }}).
    <br>
    <p> Login <a href='{{ route('contact') }}'>here</a> for more information. </p>
    <br>
    <p>Thank you.</p>
</body>
</html>