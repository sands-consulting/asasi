<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirm Your Email Address</title>
</head>
<body>
    <p>You have been appointed as Evaluator for notice: </p>
    <dd>
        <dt>Notice : </dt>
        <dl>{{ $evaluator->notice->name }} ({{ $evaluator->notice->number }})</dl>
        <dt>Evaluation Type : </dt>
        <dl>{{ $evaluator->type->name }}</dl>
    </dd>
    <br>
    <p> Please response to the request <a href='{{ route('admin.evaluators.request', $evaluator->id) }}'>here</a>. </p>
</body>
</html>