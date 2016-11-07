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
{!! Former::open_vertical(route('admin.vendors.update', $vendor->id))->method('PUT')->addClass('panel form-vendor')->novalidate() !!}
	{{ Former::populate($vendor) }}
    @include('admin.vendors._form')
	<div class="panel-footer">
		<div class="row">
			<div class="col-xs-12 col-md-9 col-md-offset-3">
				<a href="#" class="btn btn-default pull-right" v-if="!last_tab" v-on:click="next">{{ trans('actions.next') }}</a>
				<input type="submit" name="save" class="btn bg-blue-700 pull-right" value="{{ trans('actions.save') }}">
			</div>
		</div>
	</div>
{!! Former::close() !!}
@endsection
