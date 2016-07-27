@extends('layouts.admin')

@section('page-title', implode(' | ', [
	trans('places.views.create.title'),
	trans('places.title')
]))

@section('header')
<div class="page-title">
	<h4>
		{{ link_to_route('admin.places.index', trans('places.title')) }} /
		<span class="text-semibold">{{ trans('places.views.create.title') }}</span>
	</h4>
</div>
<div class="heading-elements">
	<div class="heading-btn-group">
		<a href="{{ route('admin.places.index') }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
			<i class=" icon-undo2"></i> <span>{{ trans('places.buttons.all') }}</span>
		</a>
	</div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
	<div class="panel-body">
		{!! Former::open(route('admin.places.index'))->method('POST') !!}
			{!! Former::populate($place) !!}
			@include('admin.places.form')
		{!! Former::close() !!}
	</div>
</div>
@endsection