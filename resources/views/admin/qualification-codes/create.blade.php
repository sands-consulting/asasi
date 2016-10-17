@extends('layouts.admin')

@section('page-title', implode(' | ', [
	trans('qualification-codes.views.create.title'),
	trans('qualification-codes.title')
]))

@section('header')
<div class="page-title">
	<h4>
		{{ link_to_route('admin.qualification-codes.index', trans('qualification-codes.title')) }} /
		<span class="text-semibold">{{ trans('qualification-codes.views.create.title') }}</span>
	</h4>
</div>
<div class="heading-elements">
	<div class="heading-btn-group">
		<a href="{{ route('admin.qualification-codes.index') }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
			<i class=" icon-undo2"></i> <span>{{ trans('qualification-codes.buttons.all') }}</span>
		</a>
	</div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
	<div class="panel-body">
		{!! Former::open(route('admin.qualification-codes.store'))->method('POST') !!}
			{!! Former::populate($code) !!}
			@include('admin.qualification-codes.form')
		{!! Former::close() !!}
	</div>
</div>
@endsection