@extends('layouts.portal')

@section('content')
@include('layouts.portal.widgets.wizard')

{!! Former::open_vertical_for_files(route('vendors.update', $vendor->id))->addClass('row vendor')->id('form-vendor')->method('PUT')->novalidate() !!}
	{{ Former::populate($vendor) }}
	<div class="col-xs-12 col-md-3">
        @include('admin.vendors.form.menu')
        <a href="{{ route('vendors.eligibles', Auth::user()->vendor->id) }}" class="btn btn-danger btn-block mt-10">{{ trans('actions.cancel') }}</a>
	</div>

	<div class="col-xs-12 col-md-9">
		<div class="panel panel-flat">
			<div class="tab-content">
				@include('admin.vendors.form.details')
				@include('admin.vendors.form.contact-person')
				@include('admin.vendors.form.shareholders')
				@include('admin.vendors.form.employees')
				@include('admin.vendors.form.accounts')
			</div>
			<div class="panel-footer">
				<a href="#" class="btn btn-default pull-right" v-if="!submit" v-on:click="next">{{ trans('actions.next') }}</a>
				<input name="submit" type="submit" class="btn bg-success pull-right" value="{{ trans('vendors.views._form.submit_application') }}" v-show="submit">
				<input type="submit" name="save" class="btn bg-blue-700 pull-right" value="{{ trans('actions.save') }}">
			</div>
		</div>
	</div>
{!! Former::close() !!}
@endsection
