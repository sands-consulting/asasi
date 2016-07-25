@extends('layouts.admin')

@section('header')
<div class="page-title">
	<h4>{{ link_to_route('admin.users.index', trans('users.title')) }} / <span class="text-semibold">{{ $user->name }}</span></h4>
</div>
<div class="heading-elements">
	<div class="heading-btn-group">
		@if(Auth::user()->hasPermission('user:revisions'))
		<a href="{{ route('admin.users.revisions', $user->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
			<i class="icon-database-time2"></i> <span>{{ trans('revisions.title') }}</span>
		</a>
		@endif

		@if(Auth::user()->status == 'active' && Auth::user()->hasPermission('user:activate'))
		<a href="{{ route('admin.users.suspend', $user->id) }}" data-method="PUT" class="btn btn-link btn-float text-size-small has-text text-danger legitRipple">
			<i class="icon-user-block"></i> <span>{{ trans('actions.suspend') }}</span>
		</a>
		@endif

		@if(Auth::user()->status != 'active' && Auth::user()->hasPermission('user:suspend'))
		<a href="{{ route('admin.users.activate', $user->id) }}" data-method="PUT" class="btn btn-link btn-float text-size-small has-text text-primary legitRipple">
			<i class="icon-user-check"></i> <span>{{ trans('actions.activate') }}</span>
		</a>
		@endif

		@if(Auth::user()->id != $user->id && Auth::user()->hasPermission('user:assume'))
		<a href="{{ route('admin.users.assume', $user->id) }}" data-method="POST" class="btn btn-link btn-float text-size-small has-text text-warning legitRipple">
			<i class="icon-user-lock"></i> <span>{{ trans('users.buttons.assume') }}</span>
		</a>
		@endif

		@if(Auth::user()->hasPermission('user:update'))
		<a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
			<i class="icon-pencil5"></i> <span>{{ trans('users.buttons.edit') }}</span>
		</a>
		@endif
	</div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title">{{ $user->name }}</h5>
		<div class="heading-elements">
			@include('admin.users._index_status')
		</div>
	</div>
	<div class="table-responsive">
		<table class="table">
			<tr>
				<th class="col-xs-3">{{ trans('users.attributes.email') }}</th>
				<td>{{ $user->email }}</td>
			</tr>
			<tr>
				<th class="col-xs-3">{{ trans('users.attributes.roles') }}</th>
				<td>@include('admin.users._index_roles')</td>
			</tr>
			<tr>
				<th class="col-xs-3">{{ trans('users.attributes.created_at') }}</th>
				<td>{{ $user->created_at->format('d/m/Y H:i:s') }}</td>
			</tr>
			<tr>
				<th class="col-xs-3">{{ trans('users.attributes.updated_at') }}</th>
				<td>{{ $user->updated_at->format('d/m/Y H:i:s') }}</td>
			</tr>
		</table>
	</div>
</div>
@endsection
