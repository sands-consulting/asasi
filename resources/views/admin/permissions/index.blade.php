@extends('layouts.app')

@section('page-title', trans('permissions.title'))

@section('header')
<div class="page-title">
	<h4>{{ trans('permissions.title') }}</h4>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
	<div class="panel-body form-datatable-search form-inline">
		<input type="text" name="q[keywords]" class="form-control input-sm" placeholder="{{ trans('permissions.views.index.keywords') }}" v-model="q.keywords">
		<select name="q[group]" class="form-control input-sm" v-model="q.group">
			<option value="" selected="selected">{{ trans('permissions.views.index.group') }}</option>
			@foreach(\App\Permission::getGroupOptions() as $group)<option value="{{ $group }}">{{ str_titleize($group) }}</option>@endforeach
		</select>
		<a href="#" class="btn btn-sm btn-primary" v-on:click="perform_search">{{ trans('actions.search') }}</a>
		<a href="#" class="btn btn-sm btn-default" v-show="searching" v-on:click="clear_search">{{ trans('actions.clear') }}</a>
	</div>
</div>

<div class="panel panel-flat">
	{!! $dataTable->table() !!}
</div>
@endsection

@section('scripts')
{!! $dataTable->scripts() !!}
@endsection