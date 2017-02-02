@extends('layouts.admin')

@section('header')
<div class="page-title">
    <h4>
        {{ link_to_route('admin.vendors.index', trans('vendors.title')) }} /
        {{ link_to_route('admin.vendors.show', $vendor->name, $vendor->id) }} /
        <span class="text-semibold">{{ trans('vendors.views.show.title') }}</span>
    </h4>
</div>
<div class="heading-elements">
    <div class="heading-btn-group">
        @if($vendor->canApprove())
        <a href="{{ route('admin.vendors.approve', $vendor->id) }}" class="btn btn-link btn-float text-size-small has-text text-blue legitRipple" data-method="PUT" data-confirm="{{ trans('app.confirmation') }}">
            <i class=" icon-checkmark4"></i> <span>{{ trans('vendors.buttons.approve') }}</span>
        </a>
        @endif
        @if($vendor->canReject())
        <a href="{{ route('admin.vendors.reject', $vendor->id) }}" class="btn btn-link btn-float text-size-small has-text text-danger legitRipple" data-toggle="modal" data-target="#reject-modal">
            <i class=" icon-cross2"></i> <span>{{ trans('vendors.buttons.reject') }}</span>
        </a>
        @endif
        @if(Auth::user()->hasPermission('vendor:update'))
        <a href="{{ route('admin.vendors.edit', $vendor->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple" data-method="GET">
            <i class=" icon-pencil5"></i> <span>{{ trans('vendors.buttons.edit') }}</span>
        </a>
        @endif
        @if($vendor->canSuspend())
        <a href="{{ route('admin.vendors.suspend', $vendor->id) }}" class="btn btn-link btn-float text-size-small has-text text-danger legitRipple" data-toggle="modal" data-target="#suspend-modal">
            <i class=" icon-user-lock"></i> <span>{{ trans('vendors.buttons.suspend') }}</span>
        </a>
        @endif
        @if($vendor->canActivate())
        <a href="{{ route('admin.vendors.activate', $vendor->id) }}" class="btn btn-link btn-float text-size-small has-text text-success legitRipple" data-method="PUT">
            <i class=" icon-user-check"></i> <span>{{ trans('vendors.buttons.activate') }}</span>
        </a>
        @endif
        @if(Auth::user()->hasPermission('vendor:blacklist') && $vendor->canBlacklist())
        <a href="{{ route('admin.vendors.blacklist', $vendor->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple" data-toggle="modal" data-target="#blacklist-modal">
            <i class=" icon-user-block"></i> <span>{{ trans('vendors.buttons.blacklist') }}</span>
        </a>
        @endif
        @if(Auth::user()->hasPermission('vendor:unblacklist') && $vendor->canUnblacklist())
        <a href="{{ route('admin.vendors.unblacklist', $vendor->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple" data-method="PUT">
            <i class=" icon-user-block"></i> <span>{{ trans('vendors.buttons.unblacklist') }}</span>
        </a>
        @endif
        @if(Auth::user()->hasPermission('vendor:update'))
        <a href="{{ route('admin.vendors.destroy', $vendor->id) }}" class="btn btn-link btn-float text-size-small has-text text-danger legitRipple" data-method="DELETE" data-confirm="{{ trans('app.confirmation') }}">
            <i class=" icon-trash"></i> <span>{{ trans('actions.delete') }}</span>
        </a>
        @endif
        <a href="{{ route('admin.vendors.index') }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class=" icon-undo2"></i> <span>{{ trans('actions.back') }}</span>
        </a>
    </div>
</div>
@endsection

@section('secondary-header')
<ul class="breadcrumb-elements">
    @if(Auth::user()->hasPermission('vendor:histories'))
    <li>
        <a href="{{ route('admin.vendors.histories', $vendor->id) }}" class="legitRipple">
            <i class="icon-database-time2"></i> {{ trans('user-histories.title') }}
        </a>
    </li>
    @endif

    @if(Auth::user()->hasPermission('vendor:revisions'))
    <li>
        <a href="{{ route('admin.vendors.revisions', $vendor->id) }}" class="legitRipple">
            <i class="icon-database-edit2"></i> {{ trans('revisions.title') }}
        </a>
    </li>
    @endif
</ul>
@endsection

@section('content')
@include('admin.vendors._vendor')
@include('admin.vendors._show_details')
@include('admin.vendors.modals.reject')
@endsection