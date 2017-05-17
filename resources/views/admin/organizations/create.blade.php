@extends('layouts.app')

@section('page-title', implode(' | ', [
	trans('organizations.views.create.title'),
	trans('organizations.title')
]))

@section('header')
<div class="page-title">
	<h4>
		{{ link_to_route('admin.organizations.index', trans('organizations.title')) }} /
		<span class="text-semibold">{{ trans('organizations.views.create.title') }}</span>
	</h4>
</div>
<div class="heading-elements">
	<div class="heading-btn-group">
		<a href="{{ route('admin.organizations.index') }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
			<i class=" icon-undo2"></i> <span>{{ trans('organizations.buttons.all') }}</span>
		</a>
	</div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
	<div class="panel-body">
		{!! Former::open(route('admin.organizations.index'))->method('POST') !!}
			{!! Former::populate($organization) !!}
			@include('admin.organizations.form')
		{!! Former::close() !!}
	</div>
</div>
@endsection