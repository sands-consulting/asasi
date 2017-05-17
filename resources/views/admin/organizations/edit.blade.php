@extends('layouts.app')

@section('page-title', implode(' | ', [
	trans('actions.edit'),
	$organization->name,
	trans('organizations.title')
]))

@section('header')
<div class="page-title">
	<h4>
		{{ link_to_route('admin.organizations.index', trans('organizations.title')) }} /
		{{ link_to_route('admin.organizations.show', $organization->name, null) }} /
		<span class="text-semibold">{{ trans('actions.edit') }}</span>
	</h4>
</div>
<div class="heading-elements">
	<div class="heading-btn-group">
		@can('destroy', $organization)
			<a href="{{ route('admin.organizations.destroy', $organization->id) }}"
			   class="btn btn-link btn-float text-size-small has-text legitRipple text-danger" data-method="DELETE">
				<i class="icon-trash"></i> <span>{{ trans('actions.delete') }}</span>
			</a>
		@endcan
		<a href="{{ route('admin.organizations.index') }}"
		   class="btn btn-link btn-float text-size-small has-text legitRipple">
			<i class=" icon-undo2"></i> <span>{{ trans('actions.back') }}</span>
		</a>
	</div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
	<div class="panel-body">
		{!! Former::open(route('admin.organizations.update', $organization->id))->method('PUT') !!}
			{!! Former::populate($organization) !!}
			@include('admin.organizations.form')
		{!! Former::close() !!}
	</div>
</div>
@endsection