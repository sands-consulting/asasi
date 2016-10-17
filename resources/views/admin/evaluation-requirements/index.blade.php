@extends('layouts.admin')

@section('page-title', trans('evaluations.views.settings.title'))

@section('header')
<div class="page-title">
    <h4>
        {{ link_to_route('admin.evaluations.index', trans('evaluations.title')) }} /
        <span class="text-semibold">{{ trans('evaluations.views.settings.title') }}</span>
    </h4>
</div>
<div class="heading-elements">
    <div class="heading-btn-group">
        <a href="{{ route('admin.evaluations.index') }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class=" icon-undo2"></i> <span>{{ trans('actions.back') }}</span>
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">{{ trans('evaluations.views.settings.title') }}</h5>
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
    
    {{-- <div class="panel-body">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil sapiente cumque sequi doloribus possimus maxime earum modi, esse enim eaque porro minus temporibus. Sunt animi molestias, autem aliquam modi cum?
    </div> --}}
    {!! $dataTable->table() !!}
</div>
@endsection

@section('scripts')
    {!! $dataTable->scripts() !!}
@endsection
