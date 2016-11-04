<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirm Your Email Address</title>
</head>
<body>
    <p>Your evaluation list for Notice {{ $evaluator->notice->name }} ({{ $evaluator->notice->number }}) has been updated.
    <br>
    <p> Click <a href='{{ route('admin.evaluations.index') }}'>here</a> to view the list. </p>
    <br>
    <p>Thank you.</p>
</body>
</html>