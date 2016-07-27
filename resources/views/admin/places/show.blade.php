@extends('layouts.admin')

@section('page-title', implode(' | ', [
	$place->name,
	trans('places.title')
]))

@section('header')
<div class="page-title">
	<h4>{{ link_to_route('admin.places.index', trans('places.title')) }} / <span class="text-semibold">{{ $place->name }}</span></h4>
</div>
<div class="heading-elements">
	<div class="heading-btn-group">
		@if($place->canActivate() && Auth::user()->hasPermission('place:activate'))
		<a href="{{ route('admin.places.activate', $place->id) }}" data-method="PUT" class="btn btn-link btn-float text-size-small has-text text-blue legitRipple">
			<i class="icon-check"></i> <span>{{ trans('actions.activate') }}</span>
		</a>
		@endif

		@if($place->canDeactivate() && Auth::user()->hasPermission('place:deactivate'))
		<a href="{{ route('admin.places.deactivate', $place->id) }}" data-method="PUT" class="btn btn-link btn-float text-size-small has-text text-warning legitRipple">
			<i class="icon-minus-circle2"></i> <span>{{ trans('actions.deactivate') }}</span>
		</a>
		@endif

		@if(Auth::user()->hasPermission('place:update'))
		<a href="{{ route('admin.places.edit', $place->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
			<i class="icon-pencil5"></i> <span>{{ trans('places.buttons.edit') }}</span>
		</a>
		@endif
	</div>
</div>
@endsection

@section('secondary-header')
<ul class="breadcrumb-elements">
	@if(Auth::user()->hasPermission('place:revisions'))
	<li>
		<a href="{{ route('admin.places.revisions', $place->id) }}" class="legitRipple">
			<i class="icon-database-edit2"></i> {{ trans('revisions.title') }}
		</a>
	</li>
	@endif
</ul>
@endsection

@section('content')
<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title">{{ $place->name }}</h5>
		<div class="heading-elements">
			@include('admin.places._index_status')
		</div>
	</div>
	<div class="table-responsive">
		<table class="table">
			<tr>
				<th class="col-xs-3">{{ trans('places.attributes.type') }}</th>
				<td>{{ trans('places.types.' . $place->type) }}</td>
			</tr>
			<tr>
				<th class="col-xs-3">{{ trans('places.attributes.parent') }}</th>
				<td>
					@if($place->parent)
						{!! link_to_route('admin.places.show', $place->parent->name, $place->parent_id) !!}
					@else
					<i class="icon-cross2"></i>
					@endif
				</td>
			</tr>
			<tr>
				<th class="col-xs-3">{{ trans('places.attributes.code_2') }}</th>
				<td>{!! blank_icon($place->code_2) !!}</td>
			</tr>
			<tr>
				<th class="col-xs-3">{{ trans('places.attributes.code_3') }}</th>
				<td>{!! blank_icon($place->code_3) !!}</td>
			</tr>
			<tr>
				<th class="col-xs-3">{{ trans('places.attributes.created_at') }}</th>
				<td>{{ $place->created_at->format('d/m/Y H:i:s') }}</td>
			</tr>
			<tr>
				<th class="col-xs-3">{{ trans('places.attributes.updated_at') }}</th>
				<td>{{ $place->updated_at->format('d/m/Y H:i:s') }}</td>
			</tr>
		</table>
	</div>
</div>
@endsection
