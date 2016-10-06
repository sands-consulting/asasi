@extends('layouts.admin')

@section('page-title', implode(' | ', [
	trans('actions.edit'),
	$allocation->name,
	trans('allocations.title')
]))

@section('header')
<div class="page-title">
	<h4>
		{{ link_to_route('admin.allocations.index', trans('allocations.title')) }} /
		{{ link_to_route('admin.allocations.show', $allocation->name, $allocation->id) }} /
		<span class="text-semibold">{{ trans('actions.edit') }}</span>
	</h4>
</div>
<div class="heading-elements">
	<div class="heading-btn-group">
		<a href="{{ route('admin.allocations.show', $allocation->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
			<i class=" icon-undo2"></i> <span>{{ trans('actions.back') }}</span>
		</a>
	</div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
	<div class="panel-body">
		{!! Former::open(route('admin.allocations.show', $allocation->id))->method('PUT') !!}
			{!! Former::populate($allocation) !!}
			@include('admin.allocations.form')
		{!! Former::close() !!}
	</div>
</div>
@endsection