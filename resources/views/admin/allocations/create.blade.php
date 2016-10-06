@extends('layouts.admin')

@section('page-title', implode(' | ', [
	trans('allocations.views.create.title'),
	trans('allocations.title')
]))

@section('header')
<div class="page-title">
	<h4>
		{{ link_to_route('admin.allocations.index', trans('allocations.title')) }} /
		<span class="text-semibold">{{ trans('allocations.views.create.title') }}</span>
	</h4>
</div>
<div class="heading-elements">
	<div class="heading-btn-group">
		<a href="{{ route('admin.allocations.index') }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
			<i class=" icon-undo2"></i> <span>{{ trans('allocations.buttons.all') }}</span>
		</a>
	</div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
	<div class="panel-body">
		{!! Former::open(route('admin.allocations.store'))->method('POST') !!}
			{!! Former::populate($allocation) !!}
			@include('admin.allocations.form')
		{!! Former::close() !!}
	</div>
</div>
@endsection