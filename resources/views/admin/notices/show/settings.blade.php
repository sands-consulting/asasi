@extends('admin.notices.show')

@section('show')
<div class="panel panel-flat">
    <table class="table">
        <thead>
            <th width="5%">#</th>
            <th>Name</th>
            <th width="50">Setting</th>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Invitation Only</td>
                <td><input type="checkbox"></td>
            </tr>
            <tr>
                <td>2</td>
                <td>Advertise Only</td>
                <td><input type="checkbox"></td>
            </tr>
            <tr>
                <td rowspan="{{ App\EvaluationType::whereStatus('active')->count() + 1 }}">3</td>
                <td colspan="2"><strong>Evaluation Order</strong></td>
            </tr>
            @foreach(App\EvaluationType::whereStatus('active')->get() as $type)
            <tr>
                <td>{{ $type->name }}</td>
                <td><input type="text" class="form-control input-sm"></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="panel-footer">
        <a href="#" class="btn bg-blue-700 pull-right">Save</a>
    </div>
</div>
@endsection