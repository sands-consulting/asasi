@extends('layouts.admin')

@section('page-title', implode(' | ', [
	$user->name,
	trans('users.title')
]))

@section('header')
<div class="page-title">
	<h4>{{ link_to_route('admin.users.index', trans('users.title')) }} / <span class="text-semibold">{{ $user->name }}</span></h4>
</div>
<div class="heading-elements">
	<div class="heading-btn-group">
		@if($user->canActivate() && Auth::user()->hasPermission('user:activate'))
		<a href="{{ route('admin.users.activate', $user->id) }}" data-method="PUT" class="btn btn-link btn-float text-size-small has-text text-blue legitRipple">
			<i class="icon-user-check"></i> <span>{{ trans('actions.activate') }}</span>
		</a>
		@endif

		@if($user->canSuspend() && Auth::user()->hasPermission('user:suspend'))
		<a href="{{ route('admin.users.suspend', $user->id) }}" data-method="PUT" class="btn btn-link btn-float text-size-small has-text text-danger legitRipple">
			<i class="icon-user-block"></i> <span>{{ trans('actions.suspend') }}</span>
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

		@if(Auth::user()->id != $user->id && Auth::user()->hasPermission('user:delete'))
		<a href="{{ route('admin.users.destroy', $user->id) }}" data-method="DELETE" class="btn btn-link btn-float text-size-small has-text text-danger legitRipple">
			<i class="icon-trash"></i> <span>{{ trans('actions.delete') }}</span>
		</a>
		@endif
	</div>
</div>
@endsection

@section('secondary-header')
<ul class="breadcrumb-elements">
    @if(Auth::user()->hasPermission('user:logs'))
	<li>
		<a href="{{ route('admin.users.logs', $user->id) }}" class="legitRipple">
			<i class="icon-database-time2"></i> {{ trans('user-logs.title') }}
		</a>
	</li>
	@endif

	@if(Auth::user()->hasPermission('user:revisions'))
	<li>
		<a href="{{ route('admin.users.revisions', $user->id) }}" class="legitRipple">
			<i class="icon-database-edit2"></i> {{ trans('revisions.title') }}
		</a>
	</li>
	@endif
</ul>
@endsection

@section('content')
<div class="row">
	<div class="col-md-3">
		<div class="thumbnail">
			<div class="thumb thumb-rounded thumb-slide">
				{{-- <a class="btn bg-primary-400 btn-rounded btn-icon legitRipple">
					<span class="letter-icon">{{ get_initial($user->name) }}</span>
				</a> --}}
				<img src="{{ Gravatar::src($user->email, 100) }}" 
					class="img-circle" 
					alt="{{ $user->name }}">

				<div class="caption">
					<span>
						<a href="#" class="btn bg-success-400 btn-icon btn-xs legitRipple" data-popup="lightbox"><i class="icon-plus2"></i></a>
						<a href="user_pages_profile.html" class="btn bg-success-400 btn-icon btn-xs legitRipple"><i class="icon-link"></i></a>
					</span>
				</div>
			</div>
		
	    	<div class="caption text-center">
	    		<h6 class="text-semibold">
	    			{{ $user->name }}
	    			@if ($user->vendor) 
	    				<small class="display-block">{{ $user->vendor->name }}</small>
	    			@endif
	    		</h6>

	    	</div>
		</div>

		{{-- <div class="well">
			 @if($user->canActivate() && Auth::user()->hasPermission('user:activate'))
				<a href="{{ route('admin.users.activate', $user->id) }}" 
					class="btn btn-success btn-labeled btn-block legitRipple"
					data-method="PUT">
					<b><i class="icon-user-check"></i></b> Activate
				</a>
			@endif
		
			@if($user->canSuspend() 
				&& Auth::user()->hasPermission('user:suspend'))
				<a href="{{ route('admin.users.suspend', $user->id) }}" 
					class="btn btn-danger btn-labeled btn-block legitRipple"
					data-method="PUT">
					<b><i class="icon-user-block"></i></b> Suspend user
				</a>
			@endif
		
			@if(Auth::user()->id != $user->id
				&& Auth::user()->hasPermission('user:assume'))
				<a  href="{{ route('admin.users.assume', $user->id) }}"
					class="btn btn-primary btn-labeled btn-block legitRipple"
					data-method="POST">
					<b><i class="icon-user-lock"></i></b> Login as user
				</a>
			@endif 
		</div> --}}
	</div>

	<div class="col-md-9">
		<div class="panel panel-flat">
			<div class="panel-body">
				<fieldset>
					<legend>User Information</legend>
					<dl>
						<div class="col-md-6 mb-15">
							<dt>{{ trans('users.attributes.email') }}</dt>
							<dd>{{ $user->email }}</dd>
						</div>
						<div class="col-md-6 mb-15">
							<dt>{{ trans('users.attributes.roles') }}</dt>
							<dd>@include('admin.users._index_roles')</dd>
						</div>
						<div class="col-md-6 mb-15">
							<dt>{{ trans('users.attributes.created_at') }}</dt>
							<dd>{{ $user->created_at->formatDateTimeFromSetting() }}</dd>
						</div>
						<div class="col-md-6 mb-15">
							<dt>{{ trans('users.attributes.updated_at') }}</dt>
							<dd>{{ $user->updated_at->formatDateTimeFromSetting() }}</dd>
						</div>
					</dl>
				</fieldset>
				
				@if ($user->vendor)
					<fieldset>
						<legend>Vendor Information</legend>
						<dl>
							<div class="col-md-6 mb-15">
								<dt>{{ trans('vendors.attributes.name') }}</dt>
								<dd>{{ $user->vendor->name }}</dd>
							</div>
							<div class="col-md-6 mb-15">
								<dt>{{ trans('vendors.attributes.registration_number') }}</dt>
								<dd>{{ $user->vendor->registration_number }}</dd>
							</div>
						</dl>
					</fieldset>
				@endif
			</div>
		</div>
	</div>
</div>

@endsection
