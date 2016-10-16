@extends('layouts.admin')

@section('page-title', trans('evaluations.views.settings.title'))

@section('header')
<div class="page-title">
    <h4>
        {{ trans('evaluations.title') }} /
        <span class="text-semibold">{{ trans('evaluations.views.settings.title') }}</span>
    </h4>
</div>
<div class="heading-elements">
    <div class="heading-btn-group">
        <a href="{{ route('admin.notices.show', $notice->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class=" icon-undo2"></i> <span>{{ trans('actions.back') }}</span>
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">{{ $notice->number }} - {{ $notice->name }}</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-cog3"></i><span class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="#">Notices</a></li>
                        <li><a href="{{ route('admin.evaluation-requirements.edit', $notice->id) }}">{{ trans('evaluation-requirements.title') }}</a></li>
                        <li><a href="{{ route('admin.evaluators.index', $notice->id) }}">Evaluators</a></li>
                        <li class="divider"></li>
                        <li><a href="#">All Settings</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    <div class="panel-body">
        {!! Former::open(route('admin.evaluation-requirements.update')) !!}
            @include('admin.evaluation-requirements.form')
        {!! Former::close() !!}
    </div>
</div>
@endsection
