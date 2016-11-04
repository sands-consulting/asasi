@extends('layouts.admin')

@section('page-title', trans('evaluators.views.settings.title'))

@section('header')
<div class="page-title">
    <h4>
        {{ link_to_route('admin.evaluators.index', trans('evaluators.title'), $notice->id) }} /
        <span class="text-semibold">{{ trans('evaluators.views.settings.title') }}</span>
    </h4>
</div>
<div class="heading-elements">
    <div class="heading-btn-group">
        <a href="{{ route('admin.evaluators.index', $notice->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class=" icon-undo2"></i> <span>{{ trans('actions.back') }}</span>
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">{{ trans('evaluators.views.create.title') }}</h5>
    </div>

    <div class="panel-body">
        @include('admin.evaluators.form')
    </div>
</div>
@endsection
