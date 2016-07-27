@extends('layouts.admin')

@section('page-title', implode(' | ', [
	$organization->name,
	trans('organizations.title')
]))

@section('header')
<div class="page-title">
	<h4>{{ link_to_route('admin.organizations.index', trans('organizations.title')) }} / <span class="text-semibold">{{ $organization->name }}</span></h4>
</div>
<div class="heading-elements">
	<div class="heading-btn-group">
		@if($organization->canActivate() && Auth::user()->hasPermission('organization:activate'))
		<a href="{{ route('admin.organizations.activate', $organization->id) }}" data-method="PUT" class="btn btn-link btn-float text-size-small has-text text-blue legitRipple">
			<i class="icon-check"></i> <span>{{ trans('actions.activate') }}</span>
		</a>
		@endif

		@if($organization->canDeactivate() && Auth::user()->hasPermission('organization:deactivate'))
		<a href="{{ route('admin.organizations.deactivate', $organization->id) }}" data-method="PUT" class="btn btn-link btn-float text-size-small has-text text-warning legitRipple">
			<i class="icon-minus-circle2"></i> <span>{{ trans('actions.deactivate') }}</span>
		</a>
		@endif

		@if($organization->canSuspend() && Auth::user()->hasPermission('organization:suspend'))
		<a href="{{ route('admin.organizations.suspend', $organization->id) }}" data-method="PUT" class="btn btn-link btn-float text-size-small has-text text-danger legitRipple">
			<i class="icon-blocked"></i> <span>{{ trans('actions.suspend') }}</span>
		</a>
		@endif

		@if(Auth::user()->hasPermission('organization:update'))
		<a href="{{ route('admin.organizations.edit', $organization->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
			<i class="icon-pencil5"></i> <span>{{ trans('organizations.buttons.edit') }}</span>
		</a>
		@endif
	</div>
</div>
@endsection

@section('secondary-header')
<ul class="breadcrumb-elements">
	@if(Auth::user()->hasPermission('organization:revisions'))
	<li>
		<a href="{{ route('admin.organizations.revisions', $organization->id) }}" class="legitRipple">
			<i class="icon-database-edit2"></i> {{ trans('revisions.title') }}
		</a>
	</li>
	@endif
</ul>
@endsection

@section('content')
<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title">{{ $organization->name }}</h5>
		<div class="heading-elements">
			@include('admin.organizations._index_status')
		</div>
	</div>
	<div class="table-responsive">
		<table class="table">
			<tr>
				<th class="col-xs-3">{{ trans('organizations.attributes.short_name') }}</th>
				<td>{{ $organization->short_name }}</td>
			</tr>
			<tr>
				<th class="col-xs-3">{{ trans('organizations.attributes.parent') }}</th>
				<td>@include('admin.organizations._index_parent')</td>
			</tr>
			<tr>
				<th class="col-xs-3">{{ trans('organizations.attributes.created_at') }}</th>
				<td>{{ $organization->created_at->format('d/m/Y H:i:s') }}</td>
			</tr>
			<tr>
				<th class="col-xs-3">{{ trans('organizations.attributes.updated_at') }}</th>
				<td>{{ $organization->updated_at->format('d/m/Y H:i:s') }}</td>
			</tr>
		</table>
	</div>
</div>
@endsection
