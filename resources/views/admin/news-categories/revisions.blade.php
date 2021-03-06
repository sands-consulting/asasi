@extends('layouts.app')

@section('page-title', implode(' | ', [
	trans('revisions.title'),
	$category->name,
	trans('news-categories.title')
]))

@section('header')
<div class="page-title">
	<h4>
		{{ link_to_route('admin.news-categories.index', trans('news-categories.title')) }} /
		{{ link_to_route('admin.news-categories.edit', $category->name, $category->id) }} /
		<span class="text-semibold">{{ trans('revisions.title') }}</span>
	</h4>
</div>
<div class="heading-elements">
	<div class="heading-btn-group">
		<a href="{{ route('admin.news-categories.edit', $category->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
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