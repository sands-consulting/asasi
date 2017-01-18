@extends('layouts.admin')

@section('page-title', implode(' | ', [$notice->number, trans('notices.title')]))

@section('header')
<div class="page-title">
    <h4>
        {{ link_to_route('admin.notices.index', trans('notices.title')) }} /
        <span class="text-semibold">{{ $notice->number }}</span>
    </h4>
</div>
<div class="heading-elements">
    <div class="heading-btn-group">
        @if($notice->canPublish() && Auth::user()->hasPermission('notice:publish'))
        <a href="{{ route('admin.notices.publish', $notice->id) }}" data-method="PUT" class="btn btn-link btn-float text-size-small has-text text-blue legitRipple">
            <i class="icon-check"></i> <span>{{ trans('actions.publish') }}</span>
        </a>
        @endif

        @if($notice->canUnpublish() && Auth::user()->hasPermission('notice:unpublish'))
        <a href="{{ route('admin.notices.unpublish', $notice->id) }}" data-method="PUT" class="btn btn-link btn-float text-size-small has-text text-warning legitRipple">
            <i class="icon-minus-circle2"></i> <span>{{ trans('actions.unpublish') }}</span>
        </a>
        @endif
        
        @if($notice->canCancel())
        <a href="{{ route('admin.notices.cancel', $notice->id) }}" class="btn btn-link btn-float text-size-small has-text text-danger legitRipple" data-toggle="modal" data-target="#cancel-modal">
            <i class=" icon-cancel-circle2"></i> <span>{{ trans('actions.cancel') }}</span>
        </a>
        @endif

        @if(Auth::user()->hasPermission('notice:delete'))
        <a href="#" class="btn btn-link btn-float text-size-small has-text text-danger legitRipple" data-toggle="modal" data-target="#delete-modal">
            <i class=" icon-trash"></i> <span>{{ trans('actions.delete') }}</span>
        </a>
        @endif

        @if(Auth::user()->hasPermission('notice:update'))
        <a href="{{ route('admin.notices.edit', $notice->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class="icon-pencil5"></i> <span>{{ trans('actions.edit') }}</span>
        </a>
        @endif

        <a href="{{ route('admin.notices.index') }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class=" icon-undo2"></i> <span>{{ trans('actions.back') }}</span>
        </a>
    </div>
</div>
@endsection

@section('secondary-header')
<ul class="breadcrumb breadcrumb-caret">
    <li><a href="{{ route('admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
    <li><a href="{{ route('admin.notices.index') }}">{{ trans('notices.title') }}</a></li>
    <li class="active">{{ trans('notices.views.show.title') }}</li>
</ul>
@endsection

@section('content')
<div class="panel panel-default">
    <div class="panel-body">
        <div class="pull-left text-thin"><strong>{{ $notice->organization->name }}</strong> {{ $notice->number }}</div>
        <div class="pull-right">
            <span class="label label-default">{{ $notice->type->name }}</span>
            @include('admin.notices._index_status')
        </div>
        <div class="clearfix"></div>
        <h4 class="text-thin pull-left">{{ $notice->name }}</h4>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-md-3">
        <ul class="list-group panel panel-flat">
            <a href="{{ route('admin.notices.show', $notice->id) }}" class="list-group-item{{ is_route_active('admin.notices.show', ' bg-blue-300') }}">
                <i class="icon-clipboard3"></i> {{ trans('notices.navs.details') }}
            </a>
            <a href="{{ route('admin.notices.events', $notice->id) }}" class="list-group-item{{ is_route_active('admin.notices.events', ' bg-blue-300') }}">
                <i class="icon-calendar3"></i> {{ trans('notices.navs.events') }}
            </a>
            <a href="{{ route('admin.notices.qualification_codes', $notice->id) }}" class="list-group-item{{ is_route_active('admin.notices.qualification_codes', ' bg-blue-300') }}">
                <i class="icon-stack2"></i> {{ trans('notices.navs.qualification_codes') }}
            </a>
            {{-- <a href="{{ route('admin.notices.allocations', $notice->id) }}" class="list-group-item{{ is_route_active('admin.notices.allocations', ' bg-blue-300') }}">
                <i class="icon-copy3"></i> {{ trans('notices.navs.allocations') }}
            </a> --}}
            <a href="{{ route('admin.notices.files', $notice->id) }}" class="list-group-item{{ is_route_active('admin.notices.files', ' bg-blue-300') }}">
                <i class="icon-copy3"></i> {{ trans('notices.navs.files') }}
            </a>
            {{-- <a href="{{ route('admin.notices.submission_criterias', $notice->id) }}" class="list-group-item{{ is_route_active('admin.notices.submission_criterias', ' bg-blue-300') }}">
                <i class="icon-copy3"></i> {{ trans('notices.navs.submission_criterias') }}
            </a> --}}
            <a href="{{ route('admin.evaluation-requirements.index', $notice->id) }}" class="list-group-item{{ is_route_active('admin.evaluation-requirements.edit', ' bg-blue-300') }}">
                <i class="icon-copy3"></i> {{ trans('notices.navs.evaluation_criterias') }}
            </a>
            <a href="{{ route('admin.evaluators.index', $notice->id) }}" class="list-group-item{{ is_path_active('admin/evaluators*', ' bg-blue-300') }}">
                <i class="icon-user-check"></i> {{ trans('notices.navs.evaluators') }}
            </a>
            <a href="{{ route('admin.notices.settings', $notice->id) }}" class="list-group-item{{ is_route_active('admin.notices.settings', ' bg-blue-300') }}">
                <i class="icon-cogs"></i> {{ trans('notices.navs.settings') }}
            </a>
        </ul>

        <ul class="list-group panel panel-flat">
            <a href="#" class="list-group-item">
                <i class="icon-user-check"></i> {{ trans('notices.navs.eligibles') }}
            </a>
            <a href="#" class="list-group-item">
                <i class="icon-basket"></i> {{ trans('notices.navs.purchases') }}
            </a>
            <a href="#" class="list-group-item">
                <i class="icon-file-presentation"></i> {{ trans('notices.navs.submissions') }}
            </a>
            <a href="#" class="list-group-item">
                <i class="icon-user-check"></i> {{ trans('notices.navs.evaluations') }}
            </a>
            <a href="#" class="list-group-item">
                <i class="icon-medal2"></i> {{ trans('notices.navs.award') }}
            </a>
        </ul> --}}
    </div>

    <div class="col-xs-12 col-md-9">
        @yield('show')
    </div>
</div>

{{-- Modals --}}
@include('admin.notices.modals.cancel')
@include('admin.notices.modals.delete')
@endsection
