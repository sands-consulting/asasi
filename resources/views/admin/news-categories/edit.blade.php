@extends('layouts.admin')

@section('page-title', implode(' | ', [
	$category->name,
	trans('news-categories.title')
]))

@section('header')
<div class="page-title">
	<h4>
		{{ link_to_route('admin.news-categories.index', trans('news-categories.title')) }} /
		{{ $category->name }}
	</h4>
</div>
<div class="heading-elements">
	<div class="heading-btn-group">
		@if(Auth::user()->hasPermission('news-category:delete'))
		<a href="{{ route('admin.news-categories.destroy', $category->slug) }}" data-method="DELETE" class="btn btn-link btn-float text-size-small has-text text-danger legitRipple">
			<i class="icon-trash"></i> <span>{{ trans('actions.delete') }}</span>
		</a>
		@endif

		<a href="{{ route('admin.news-categories.index') }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
			<i class="icon-undo2"></i> <span>{{ trans('news-categories.buttons.all') }}</span>
		</a>
	</div>
</div>
@endsection

@section('secondary-header')
<ul class="breadcrumb-elements">
    @if(Auth::user()->hasPermission('news-category:histories'))
	<li>
		<a href="{{ route('admin.news-categories.histories', $category->slug) }}" class="legitRipple">
			<i class="icon-database-time2"></i> {{ trans('user-histories.title') }}
		</a>
	</li>
	@endif

	@if(Auth::user()->hasPermission('news-category:revisions'))
	<li>
		<a href="{{ route('admin.news-categories.revisions', $category->id) }}" class="legitRipple">
			<i class="icon-database-edit2"></i> {{ trans('revisions.title') }}
		</a>
	</li>
	@endif
</ul>
@endsection

@section('content')
<div class="panel panel-flat">
	<div class="panel-body">
		{!! Former::open(route('admin.news-categories.update', $category->slug))->method('PUT') !!}
			{!! Former::populate($category) !!}
			@include('admin.news-categories.form')
		{!! Former::close() !!}
	</div>
</div>@endsection