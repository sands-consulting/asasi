@extends('layouts.app')

@section('page-title', implode(' | ', [
	trans('news-categories.views.create.title'),
	trans('news-categories.title')
]))

@section('header')
<div class="page-title">
	<h4>
		{{ link_to_route('admin.news-categories.index', trans('news-categories.title')) }} /
		<span class="text-semibold">{{ trans('news-categories.views.create.title') }}</span>
	</h4>
</div>
<div class="heading-elements">
	<div class="heading-btn-group">
		<a href="{{ route('admin.news-categories.index') }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
			<i class=" icon-undo2"></i> <span>{{ trans('news-categories.buttons.all') }}</span>
		</a>
	</div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
	<div class="panel-body">
		{!! Former::open(route('admin.news-categories.store'))->method('POST') !!}
			{!! Former::populate($category) !!}
			@include('admin.news-categories.form')
		{!! Former::close() !!}
	</div>
</div>
@endsection