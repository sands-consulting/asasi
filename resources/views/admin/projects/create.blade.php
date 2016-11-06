@extends('layouts.admin')

@section('page-title', implode(' | ', [
	trans('projects.views.create.title'),
	trans('projects.title')
]))

@section('header')
<div class="page-title">
	<h4>
		{{ link_to_route('admin.projects.index', trans('projects.title')) }} /
		<span class="text-semibold">{{ trans('projects.views.create.title') }}</span>
	</h4>
</div>
<div class="heading-elements">
	<div class="heading-btn-group">
		<a href="{{ route('admin.projects.index') }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
			<i class=" icon-undo2"></i> <span>{{ trans('projects.buttons.all') }}</span>
		</a>
	</div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
	<div class="panel-body">
		{!! Former::open_vertical(route('admin.projects.store'))->method('POST') !!}
			<div class="row">
				<div class="col-sm-12">
					{!! Former::select('notice_id')
						->options(App\Notice::options())
						->label('projects.attributes.notice')
						->placeholder('Select from notice')
						->addClass('select2') !!}
				</div>
			</div>
			<div class="col-sm-12">
				<div class="text-right"> 
					{!! Former::submit(trans('actions.create'))->addClass('bg-blue')->data_confirm(trans('app.confirmation')) !!}
				</div>
			</div>
		{!! Former::close() !!}

		<div class="text-center text-size-xlarge text-semibold">OR</div>

		{!! Former::open_vertical(route('admin.projects.store'))->method('POST') !!}
			@include('admin.projects.form')
		{!! Former::close() !!}
	</div>
</div>
@endsection