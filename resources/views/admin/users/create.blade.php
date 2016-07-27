@extends('layouts.admin')

@section('page-title', implode(' | ', [
	trans('users.views.index.title'),
	trans('users.title')
]))

@section('header')
<div class="page-title">
	<h4>
		{{ link_to_route('admin.users.index', trans('users.title')) }} /
		<span class="text-semibold">{{ trans('users.buttons.create') }}</span>
	</h4>
</div>
<div class="heading-elements">
	<div class="heading-btn-group">
		<a href="{{ route('admin.users.index') }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
			<i class=" icon-undo2"></i> <span>{{ trans('users.buttons.all') }}</span>
		</a>
	</div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
	<div class="panel-body">
		{!! Former::open(action('Admin\UsersController@store'))->method('POST') !!}
			{!! Former::populate($user) !!}
			@include('admin.users.form')
		{!! Former::close() !!}
	</div>
</div>
@endsection