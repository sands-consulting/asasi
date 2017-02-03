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
    <li class="active">{{ trans('notices.views.admin.show.title') }}</li>
</ul>
@endsection

@section('content')
@include('admin.notices.show.header')

<div class="row">
    <div class="col-xs-12 col-md-3">
        @include('admin.notices.show.nav')
    </div>

    <div class="col-xs-12 col-md-9">
        @yield('show')
    </div>
</div>

{{-- Modals --}}
@include('admin.notices.modals.cancel')
@include('admin.notices.modals.delete')
@endsection
