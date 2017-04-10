@extends('layouts.admin')

@section('header')
<div class="page-title">
	<h4>
		{{ link_to_route('admin.vendors.index', trans('vendors.title')) }} /
		{{ link_to_route('admin.vendors.show', $vendor->name, $vendor->id) }} /
		<span class="text-semibold">{{ trans('vendors.views.admin.edit.title') }}</span>
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
{!! Former::open_vertical_for_files(route('admin.vendors.show', $vendor->id))->addClass('row admin')->id('form-vendor')->novalidate() !!}
	{{ method_field('PUT') }}
	@include('admin.vendors.form')
{!! Former::close() !!}
@endsection
