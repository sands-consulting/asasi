@extends('layouts.admin')

@section('page-title', implode(' | ', [
	trans('actions.edit'),
	$code->name,
	trans('qualification-codes.title')
]))

@section('header')
<div class="page-title">
	<h4>
		{{ link_to_route('admin.qualification-codes.index', trans('qualification-codes.title')) }} /
		{{ link_to_route('admin.qualification-codes.show', $code->name, $code->id) }} /
		<span class="text-semibold">{{ trans('actions.edit') }}</span>
	</h4>
</div>
<div class="heading-elements">
	<div class="heading-btn-group">
		<a href="{{ route('admin.qualification-codes.show', $code->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
			<i class=" icon-undo2"></i> <span>{{ trans('actions.back') }}</span>
		</a>
	</div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
	<div class="panel-body">
		{!! Former::open(route('admin.qualification-codes.show', $code->id))->method('PUT') !!}
			{!! Former::populate($code) !!}
			@include('admin.qualification-codes.form')
		{!! Former::close() !!}
	</div>
</div>
@endsection