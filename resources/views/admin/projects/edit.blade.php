@extends('layouts.admin')

@section('page-title', implode(' | ', [
	trans('actions.edit'),
	$project->number,
	trans('projects.title')
]))

@section('header')
<div class="page-title">
	<h4>
		{{ link_to_route('admin.projects.index', trans('projects.title')) }} /
		{{ link_to_route('admin.projects.show', $project->number, $project->id) }} /
		<span class="text-semibold">{{ trans('actions.edit') }}</span>
	</h4>
</div>
<div class="heading-elements">
	<div class="heading-btn-group">
		<a href="{{ route('admin.projects.show', $project->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
			<i class=" icon-undo2"></i> <span>{{ trans('actions.back') }}</span>
		</a>
	</div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
	<div class="panel-body">
		{!! Former::open_vertical(route('admin.projects.show', $project->id))->method('PUT') !!}
			{!! Former::populate($project) !!}
			@include('admin.projects.form')
		{!! Former::close() !!}
	</div>
</div>
@endsection