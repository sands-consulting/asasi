@extends('layouts.admin')

@section('page-title', implode(' | ', [
	$news->title,
	trans('news.title')
]))

@section('header')
<div class="page-title">
	<h4>
		{{ link_to_route('admin.news.index', trans('news.title')) }} /
		{{ $news->title }}
	</h4>
</div>
<div class="heading-elements">
	<div class="heading-btn-group">
		@if($news->canPublish() && Auth::user()->hasPermission('news:publish'))
		<a href="{{ route('admin.news.publish', $news->slug) }}" data-method="PUT" class="btn btn-link btn-float text-size-small has-text text-blue legitRipple">
			<i class="icon-check"></i> <span>{{ trans('actions.publish') }}</span>
		</a>
		@endif

		@if($news->canUnpublish() && Auth::user()->hasPermission('news:unpublish'))
		<a href="{{ route('admin.news.unpublish', $news->slug) }}" data-method="PUT" class="btn btn-link btn-float text-size-small has-text text-danger legitRipple">
			<i class="icon-blocked"></i> <span>{{ trans('actions.unpublish') }}</span>
		</a>
		@endif

		@if(Auth::user()->hasPermission('news:delete'))
		<a href="{{ route('admin.news.destroy', $news->slug) }}" data-method="DELETE" class="btn btn-link btn-float text-size-small has-text text-danger legitRipple">
			<i class="icon-trash"></i> <span>{{ trans('actions.delete') }}</span>
		</a>
		@endif

		<a href="{{ route('admin.news.index') }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
			<i class="icon-undo2"></i> <span>{{ trans('news.buttons.all') }}</span>
		</a>
	</div>
</div>
@endsection

@section('secondary-header')
<ul class="breadcrumb breadcrumb-caret">
    <li><a href="{{ route('admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
    <li><a href="{{ route('admin.news.index') }}">{{ trans('news.title') }}</a></li>
    <li class="active">{{ trans('news.views.edit.title') }}</li>
</ul>
<ul class="breadcrumb-elements">
    @if(Auth::user()->hasPermission('news:histories'))
	<li>
		<a href="{{ route('admin.news.histories', $news->id) }}" class="legitRipple">
			<i class="icon-database-time2"></i> {{ trans('user-histories.title') }}
		</a>
	</li>
	@endif

	@if(Auth::user()->hasPermission('news:revisions'))
	<li>
		<a href="{{ route('admin.news.revisions', $news->id) }}" class="legitRipple">
			<i class="icon-database-edit2"></i> {{ trans('revisions.title') }}
		</a>
	</li>
	@endif
</ul>
@endsection

@section('content')
{!! Former::vertical_open(route('admin.news.update', $news->id))->method('PUT') !!}
	{!! Former::populate($news) !!}
	@include('admin.news.form')
{!! Former::close() !!}
@endsection