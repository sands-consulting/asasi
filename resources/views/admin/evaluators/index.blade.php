@extends('layouts.admin')

@section('header')
<div class="page-title">
    <h4>
        <span>{{ trans('evaluators.title') }}</span> /
        <span class="text-semibold">{{ trans('notices.views.settings.title') }}</span>
    </h4>
</div>
<div class="heading-elements">
    <div class="heading-btn-group">
        <a href="{{ route('admin.evaluators.edit', $notice->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class=" icon-pencil"></i> <span>{{ trans('actions.edit') }}</span>
        </a>
        <a href="{{ route('admin.notices.show', $notice->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class=" icon-undo2"></i> <span>{{ trans('actions.back') }}</span>
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
    <div class="panel-heading">
        <div class="row">
            <div class="col-sm-10 panel-title"><span class="text-muted">{{ $notice->number}} (<i>{{ $notice->organization->name}}</i>)</span>
            <br>{{ $notice->name }}</div>
            <div class="col-sm-2 heading-elements">
                @if ($notice->status == 'published')
                    <span class="label label-success heading-text">
                @elseif ($notice->status == 'cancelled')
                    <span class="label label-danger heading-text">
                @else
                    <span class="label label-default heading-text">
                @endif
                {{ $notice->status }}</span>
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
    </div>
    {!! $dataTable->table() !!}
</div>
@endsection

@section('scripts')
    {!! $dataTable->scripts() !!}
@endsection
