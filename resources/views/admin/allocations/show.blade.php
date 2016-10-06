@extends('layouts.admin')

@section('page-title', implode(' | ', [
	$allocation->name,
	trans('allocations.title')
]))

@section('header')
<div class="page-title">
	<h4>{{ link_to_route('admin.allocations.index', trans('allocations.title')) }} / <span class="text-semibold">{{ $allocation->name }}</span></h4>
</div>
<div class="heading-elements">
	<div class="heading-btn-group">
		@if(Auth::user()->hasPermission('allocation:update'))
		<a href="{{ route('admin.allocations.edit', $allocation->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
			<i class="icon-pencil5"></i> <span>{{ trans('allocations.buttons.edit') }}</span>
		</a>
		@endif

		@if(Auth::user()->id != $allocation->id && Auth::user()->hasPermission('allocation:delete'))
		<a href="{{ route('admin.allocations.destroy', $allocation->id) }}" data-method="DELETE" class="btn btn-link btn-float text-size-small has-text text-danger legitRipple">
			<i class="icon-trash"></i> <span>{{ trans('actions.delete') }}</span>
		</a>
		@endif
	</div>
</div>
@endsection

@section('secondary-header')
<ul class="breadcrumb-elements">
    @if(Auth::user()->hasPermission('allocation:logs'))
	<li>
		<a href="{{ route('admin.allocations.logs', $allocation->id) }}" class="legitRipple">
			<i class="icon-database-time2"></i> {{ trans('user-logs.title') }}
		</a>
	</li>
	@endif

	@if(Auth::user()->hasPermission('allocation:revisions'))
	<li>
		<a href="{{ route('admin.allocations.revisions', $allocation->id) }}" class="legitRipple">
			<i class="icon-database-edit2"></i> {{ trans('revisions.title') }}
		</a>
	</li>
	@endif
</ul>
@endsection

@section('content')
<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title">{{ $allocation->name }}</h5>
		<div class="heading-elements">
			@include('admin.allocations._index_status')
		</div>
	</div>
	<div class="table-responsive">
		<table class="table">
			<tr>
				<th class="col-xs-3">{{ trans('allocations.attributes.value') }}</th>
				<td>{{ number_format($allocation->value, 2) }}</td>
			</tr>
			<tr>
				<th class="col-xs-3">{{ trans('allocations.attributes.type') }}</th>
				<td>{{ $allocation->type->name }}</td>
			</tr>
			<tr>
				<th class="col-xs-3">{{ trans('allocations.attributes.organization') }}</th>
				<td>{{ $allocation->organization->name }}</td>
			</tr>
			<tr>
				<th class="col-xs-3">{{ trans('allocations.attributes.created_at') }}</th>
				<td>{{ $allocation->created_at->format('d/m/Y H:i:s') }}</td>
			</tr>
			<tr>
				<th class="col-xs-3">{{ trans('allocations.attributes.updated_at') }}</th>
				<td>{{ $allocation->updated_at->format('d/m/Y H:i:s') }}</td>
			</tr>
		</table>
	</div>
</div>
@endsection
