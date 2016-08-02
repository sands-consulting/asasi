@extends('layouts.admin')

@section('header')
<div class="page-title">
	<h4>
		{{ link_to_route('admin.vendors.index', trans('vendors.views.index.title')) }} /
		{{ link_to_route('admin.vendors.show', $vendor->name, $vendor->id) }} /
		<span class="text-semibold">{{ trans('vendors.views.edit.title') }}</span>
	</h4>
</div>
<div class="heading-elements">
	<div class="heading-btn-group">
		<a href="{{ route('admin.vendors.show', $vendor->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
			<i class=" icon-undo2"></i> <span>{{ trans('actions.back') }}</span>
		</a>
	</div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
	<div class="panel-body">
		{!! Former::open(action('Admin\VendorsController@update', $vendor->id))->method('PUT') !!}
			{!! Former::populate($vendor) !!}
			@include('admin.vendors.form')
			<div class="form-group">
			    <div class="col-lg-10 col-sm-8 col-lg-offset-2 col-sm-offset-4">
			        {!! Former::submit(trans('actions.save'))->addClass('bg-blue')->data_confirm(trans('app.confirmation')) !!}
			        {!! link_to_route('admin.vendors.show', trans('actions.cancel'), $vendor->id, ['class' => 'btn btn-default']) !!}
			    </div>
			</div>
		{!! Former::close() !!}
	</div>
</div>
@endsection