@extends('layouts.admin')

@section('header')
<div class="page-title">
    <h4>
        {{ link_to_route('admin.vendors.index', trans('vendors.title')) }} /
        <span class="text-semibold">{{ $vendor->name }}</span>
    </h4>
</div>
<div class="heading-elements">
    <div class="heading-btn-group">
        @can('approve', $vendor)
        <a href="{{ route('admin.vendors.approve', $vendor->id) }}" class="btn btn-link btn-float text-size-small has-text text-blue legitRipple" data-method="PUT" data-confirm="{{ trans('app.confirmation') }}">
            <i class=" icon-checkmark4"></i> <span>{{ trans('vendors.buttons.approve') }}</span>
        </a>
        @endcan
        
        @can('reject', $vendor)
        <a href="{{ route('admin.vendors.reject', $vendor->id) }}" class="btn btn-link btn-float text-size-small has-text text-danger legitRipple" data-toggle="modal" data-target="#modal-reject">
            <i class=" icon-cross2"></i> <span>{{ trans('vendors.buttons.reject') }}</span>
        </a>
        @endcan
        
        @can('edit', $vendor)
        <a href="{{ route('admin.vendors.edit', $vendor->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple" data-method="GET">
            <i class=" icon-pencil5"></i> <span>{{ trans('vendors.buttons.edit') }}</span>
        </a>
        @endcan
        
        @can('suspend', $vendor)
        <a href="{{ route('admin.vendors.suspend', $vendor->id) }}" class="btn btn-link btn-float text-size-small has-text text-danger legitRipple" data-toggle="modal" data-target="#suspend-modal">
            <i class=" icon-user-lock"></i> <span>{{ trans('vendors.buttons.suspend') }}</span>
        </a>
        @endcan
        
        @can('activate', $vendor)
        <a href="{{ route('admin.vendors.activate', $vendor->id) }}" class="btn btn-link btn-float text-size-small has-text text-success legitRipple" data-method="PUT">
            <i class=" icon-user-check"></i> <span>{{ trans('vendors.buttons.activate') }}</span>
        </a>
        @endcan
    
        @can('destroy', $vendor)
        <a href="{{ route('admin.vendors.destroy', $vendor->id) }}" class="btn btn-link btn-float text-size-small has-text text-danger legitRipple" data-method="DELETE" data-confirm="{{ trans('app.confirmation') }}">
            <i class=" icon-trash"></i> <span>{{ trans('actions.delete') }}</span>
        </a>
        @endcan
        
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
@include('admin.vendors.show.header')
    
<div class="row">
    <div class="col-xs-12 col-md-3">
        @include('admin.vendors.show.menu')
    </div>

    <div class="col-xs-12 col-md-9">
    </div>
</div>

@include('admin.vendors.modals.reject')
@endsection