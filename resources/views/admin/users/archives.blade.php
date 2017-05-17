@extends('layouts.app')

@section('page-title', trans('users.title'))

@section('header')
<div class="page-title">
	<h4>{{ trans('users.views.archives.title') }}</h4>
</div>
<div class="heading-elements">
	<div class="heading-btn-group">
		{{-- <a href="{{ route('admin.users.index') }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
			<i class=" icon-user-plus"></i> <span>{{ trans('users.buttons.create') }}</span>
		</a> --}}
	</div>
</div>
@endsection

@section('secondary-header')
<ul class="breadcrumb breadcrumb-caret">
	<li><a href="{{ route('admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
	<li><a href="{{ route('admin.users.index') }}">{{ trans('users.title') }}</a></li>
	<li class="active">{{ trans('users.views.archives.title') }}</li>
</ul>
<ul class="breadcrumb-elements">
	<li>
		<a href="{{ route('admin.users.index') }}" class="legitRipple">
			<i class="icon-users"></i> {{ trans('users.views.index.link') }}
		</a>
	</li>
</ul>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-flat">
			<div class="panel-body form-datatable-search form-inline">
				<input type="text" name="q[keywords]" class="form-control input-sm" placeholder="{{ trans('users.views.index.keywords') }}" v-model="q.keywords">
				<select name="q[role]" class="form-control input-sm" v-model="q.role">
					<option value="" selected="selected">{{ trans('users.views.index.role') }}</option>
					@foreach(\App\Role::all() as $role)<option value="{{ $role->id }}">{{ $role->display_name }}</option>@endforeach
				</select>
				<select name="q[status]" class="form-control input-sm" v-model="q.status">
					<option value="" selected="selected">{{ trans('users.views.index.status') }}</option>
					@foreach(collect(trans('statuses'))->only('active', 'suspended', 'inactive') as $key => $value)<option value="{{ $key }}">{{ $value }}</option>@endforeach
				</select>
				<a href="#" class="btn btn-sm btn-primary" v-on:click="perform_search">{{ trans('actions.search') }}</a>
				<a href="#" class="btn btn-sm btn-default" v-show="searching" v-on:click="clear_search">{{ trans('actions.clear') }}</a>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="panel panel-flat">
			{!! $dataTable->table() !!}
		</div>	
	</div>
</div>
@endsection

@section('scripts')
{!! $dataTable->scripts() !!}
@endsection