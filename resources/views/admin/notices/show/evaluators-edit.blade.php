@extends('admin.notices.show')

@section('show')
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">{{ trans('evaluators.views.create.title') }}</h5>
    </div>

    <div class="panel-body">
        @include('admin.evaluators.form')
    </div>
</div>
@endsection