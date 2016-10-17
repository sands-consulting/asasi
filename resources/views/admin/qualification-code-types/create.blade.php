@extends('layouts.admin')

@section('page-title', implode(' | ', [
	trans('qualification-code-types.views.create.title'),
	trans('qualification-code-types.title')
]))

@section('header')
<div class="page-title">
	<h4>
		{{ link_to_route('admin.qualification-code-types.index', trans('qualification-code-types.title')) }} /
		<span class="text-semibold">{{ trans('qualification-code-types.views.create.title') }}</span>
	</h4>
</div>
<div class="heading-elements">
	<div class="heading-btn-group">
		<a href="{{ route('admin.qualification-code-types.index') }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
			<i class=" icon-undo2"></i> <span>{{ trans('qualification-code-types.buttons.all') }}</span>
		</a>
	</div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
	<div class="panel-body">
		{!! Former::open(route('admin.qualification-code-types.store'))->method('POST') !!}
			{!! Former::populate($type) !!}
			@include('admin.qualification-code-types.form')
		{!! Former::close() !!}
	</div>
</div>
@endsection