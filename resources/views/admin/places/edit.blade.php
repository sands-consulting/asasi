@extends('layouts.admin')

@section('page-title', implode(' | ', [
	trans('actions.edit'),
	$place->name,
	trans('places.title')
]))

@section('header')
<div class="page-title">
	<h4>
		{{ link_to_route('admin.places.index', trans('places.title')) }} /
		{{ link_to_route('admin.places.show', $place->name, $place->id) }} /
		<span class="text-semibold">{{ trans('actions.edit') }}</span>
	</h4>
</div>
<div class="heading-elements">
	<div class="heading-btn-group">
		@can('destroy', $place)
			<a href="{{ route('admin.places.destroy', $place->id) }}"
			   class="btn btn-link btn-float text-size-small has-text legitRipple text-danger" data-method="DELETE">
				<i class="icon-trash"></i> <span>{{ trans('actions.delete') }}</span>
			</a>
		@endcan
		<a href="{{ route('admin.places.index') }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
			<i class=" icon-undo2"></i> <span>{{ trans('actions.back') }}</span>
		</a>
	</div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
	<div class="panel-body">
		{!! Former::open(route('admin.places.update', $place->id))->method('PUT') !!}
			{!! Former::populate($place) !!}
			@include('admin.places.form')
		{!! Former::close() !!}
	</div>
</div>
@endsection