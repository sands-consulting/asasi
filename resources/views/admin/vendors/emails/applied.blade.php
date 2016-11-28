<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vendor Application</title>
</head>
<body>
    <p>Vendor {{ $vendor->name }} has sent their appllication for approval.</p>
    <br>
    <p>You may approve/reject the application <a href='{{ route('admin.vendors.show', $vendor->id) }}'>here</a>. </p>
</body>
</html>