@extends('admin.notices.show')

@section('show')
<div class="panel panel-flat">
    <div class="panel-body">
        {!! Former::open(route('admin.evaluation-requirements.update')) !!}
            @include('admin.evaluation-requirements.form')
        {!! Former::close() !!}
    </div>
</div>
@endsection