@extends('layouts.app')

@section('page-title', implode(' | ', [
	trans('revisions.title'),
	$role->display_name,
	trans('roles.title')
]))

@section('header')
<div class="page-title">
	<h4>
		{{ link_to_route('admin.roles.index', trans('roles.title')) }} /
		{{ $role->display_name }} /
		<span class="text-semibold">{{ trans('revisions.title') }}</span>
	</h4>
</div>
<div class="heading-elements">
	<div class="heading-btn-group">
		<a href="{{ route('admin.roles.index') }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
			<i class=" icon-undo2"></i> <span>{{ trans('actions.back') }}</span>
		</a>
	</div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
	{!! $dataTable->table() !!}
</div>
@endsection

@section('scripts')
{!! $dataTable->scripts() !!}
@endsection