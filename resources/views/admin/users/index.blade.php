@extends('layouts.admin')

@section('page-title', trans('users.title'))

@section('header')
<div class="page-title">
	<h4>{{ trans('users.title') }}</h4>
</div>
<div class="heading-elements">
	<div class="heading-btn-group">
		<a href="{{ route('admin.users.create') }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
			<i class=" icon-user-plus"></i> <span>{{ trans('users.buttons.create') }}</span>
		</a>
	</div>
</div>
@endsection

@section('secondary-header')
<ul class="breadcrumb breadcrumb-caret">
	<li><a href="{{ route('admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
	<li class="active">{{ trans('users.title') }}</li>
</ul>
<ul class="breadcrumb-elements">
	<li>
		<a href="{{ route('admin.users.archives') }}" class="legitRipple">
			<i class="icon-trash"></i> {{ trans('users.views.archives.link') }}
		</a>
	</li>
</ul>
@endsection

@section('content')
<div class="panel panel-flat">
	<div class="panel-body form-datatable-search form-inline">
		<input type="text" name="q[keywords]" class="form-control input-sm" placeholder="{{ trans('users.views.index.keywords') }}" v-model="q.keywords">
        <select name="q[role]" class="form-control input-sm" v-model="q.role">
            <option value="">{{ trans('users.views.index.role') }}</option>
			@foreach(\App\Role::all() as $role)<option>{{ $role->display_name }}</option>@endforeach
		</select>
		@{{ q.role }}
		<select name="q[status]" class="form-control input-sm" v-model="q.status">
			<option value="">{{ trans('users.views.index.status') }}</option>
			@foreach(collect(trans('statuses'))->only('active', 'suspended', 'inactive') as $key => $value)<option>{{ $value }}</option>@endforeach
		</select>
        @{{ q.status }}
		<a href="#" class="btn btn-sm btn-primary" @click="perform_search">{{ trans('actions.search') }}</a>
		<a href="#" class="btn btn-sm btn-default" v-show="searching" @click="clear_search">{{ trans('actions.clear') }}</a>
	</div>
</div>

<div class="panel panel-flat">
	{!! $dataTable->table() !!}
</div>
@endsection

@section('scripts')
{!! $dataTable->scripts() !!}
@endsection