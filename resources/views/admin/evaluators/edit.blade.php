@extends('layouts.admin')

@section('page-title', trans('evaluations.views.settings.title'))

@section('header')
<div class="page-title">
    <h4>
        {{ link_to_route('admin.evaluation-requirements.index', trans('evaluations.title')) }} /
        <span class="text-semibold">{{ trans('evaluations.views.settings.title') }}</span>
    </h4>
</div>
<div class="heading-elements">
    <div class="heading-btn-group">
        <a href="{{ route('admin.evaluation-requirements.index') }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class=" icon-undo2"></i> <span>{{ trans('actions.back') }}</span>
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">{{ trans('evaluations.views.settings.title') }}</h5>
    </div>

    <div class="panel-body">
        {!! Former::open(route('admin.evaluation-requirements.update')) !!}
            @include('admin.evaluation-requirements.form')
        {!! Former::close() !!}
    </div>
</div>
@endsection
