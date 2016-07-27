@extends('layouts.admin')

@section('page-title', implode(' | ', [
	trans('roles.buttons.views.title'),
	trans('roles.title')
]))

@section('header')
<div class="page-title">
	<h4>
		{{ link_to_route('admin.roles.index', trans('roles.title')) }} /
		<span class="text-semibold">{{ trans('roles.buttons.views.title') }}</span>
	</h4>
</div>
<div class="heading-elements">
	<div class="heading-btn-group">
		<a href="{{ route('admin.roles.index') }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
			<i class=" icon-undo2"></i> <span>{{ trans('roles.buttons.all') }}</span>
		</a>
	</div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
	<div class="panel-body">
		{!! Former::vertical_open(route('admin.roles.index'))->method('POST') !!}
			{!! Former::populate($role) !!}
			@include('admin.roles.form')
		{!! Former::close() !!}
	</div>
</div>
@endsection