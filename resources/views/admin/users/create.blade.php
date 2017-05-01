@extends('layouts.admin')

@section('page-title', implode(' | ', [
	trans('users.views.create.title'),
	trans('users.title')
]))

@section('header')
<div class="page-title">
	<h4>
		{{ link_to_route('admin.users.index', trans('users.title')) }} /
		<span class="text-semibold">{{ trans('users.views.create.title') }}</span>
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

@section('secondary-header')
<ul class="breadcrumb breadcrumb-caret">
    <li><a href="{{ route('admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
    <li><a href="{{ route('admin.users.create') }}">{{ trans('users.title') }}</a></li>
    <li class="active">{{ trans('users.views.create.title') }}</li>
</ul>
@endsection

@section('content')
{!! Former::open(route('admin.users.store'))->id('form-admin-user') !!}
	{!! Former::populate($user) !!}
	@include('admin.users.form')
{!! Former::close() !!}
@endsection