@extends('layouts.admin')

@section('header')
<div class="page-title">
	<h4>
		{{ link_to_route('admin.users.index', trans('users.views.create.title')) }} /
		{{ link_to_route('admin.users.show', $user->name, $user->id) }} /
		<span class="text-semibold">{{ trans('users.views.edit.title') }}</span>
	</h4>
</div>
<div class="heading-elements">
	<div class="heading-btn-group">
		<a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
			<i class=" icon-undo2"></i> <span>{{ trans('actions.back') }}</span>
		</a>
	</div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
	<div class="panel-body">
		{!! Former::open(action('Admin\UsersController@update', $user->id))->method('PUT') !!}
			{!! Former::populate($user) !!}
			@include('admin.users.form')
		{!! Former::close() !!}
	</div>
</div>
@endsection