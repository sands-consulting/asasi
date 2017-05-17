@extends('layouts.app')

@section('page-title', implode(' | ', [
	trans('actions.edit'),
	$role->display_name,
	trans('roles.title')
]))

@section('header')
<div class="page-title">
	<h4>
		{{ link_to_route('admin.roles.index', trans('roles.title')) }} /
		{{ $role->display_name }} /
		<span class="text-semibold">{{ trans('actions.edit') }}</span>
	</h4>
</div>
<div class="heading-elements">
	<div class="heading-btn-group">
        @can('destroy', $role)
            <a href="{{ route('admin.roles.destroy', $role->id) }}"
               class="btn btn-link btn-float text-size-small has-text legitRipple text-danger" data-method="DELETE">
                <i class="icon-trash"></i> <span>{{ trans('actions.delete') }}</span>
		</a>
        @endcan

        <a href="{{ route('admin.roles.revisions', $role->id) }}"
           class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class="icon-database-edit2"></i> <span>{{ trans('revisions.title') }}</span>
        </a>

		<a href="{{ route('admin.roles.index') }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
			<i class=" icon-undo2"></i> <span>{{ trans('actions.back') }}</span>
		</a>
	</div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
	<div class="panel-body">
		{!! Former::vertical_open(route('admin.roles.update', $role->id))->method('PUT') !!}
			{!! Former::populate($role) !!}
			@include('admin.roles.form')
		{!! Former::close() !!}
	</div>
</div>
@endsection