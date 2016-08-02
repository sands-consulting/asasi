@extends('layouts.admin')

@section('page-title', implode(' | ', [
	trans('news.views.create.title'),
	trans('news.title')
]))

@section('header')
<div class="page-title">
	<h4>
		{{ link_to_route('admin.news.index', trans('news.title')) }} /
		<span class="text-semibold">{{ trans('news.views.create.title') }}</span>
	</h4>
</div>
<div class="heading-elements">
	<div class="heading-btn-group">
		<a href="{{ route('admin.news.index') }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
			<i class=" icon-undo2"></i> <span>{{ trans('news.buttons.all') }}</span>
		</a>
	</div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
	<div class="panel-body">
		{!! Former::vertical_open(route('admin.news.index'))->method('POST') !!}
			{!! Former::populate($news) !!}
			@include('admin.news.form')
		{!! Former::close() !!}
	</div>
</div>
@endsection