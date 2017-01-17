@extends('layouts.public')

@section('content')
	{!! Former::open_vertical_for_files(route('vendors.update', $vendor->id))
		->method('PUT')
		->addClass('panel form-vendor')
		->novalidate() !!}
		{{ Former::populate($vendor) }}
        <div class="panel-heading">
            <h4 class="panel-title">{{ trans($vendor->status == 'pending' ? 'vendors.views.edit.application.title' : 'vendors.views.edit.details.title') }}</h4>
            @if($vendor->status == 'pending')<p class="text-muted">{{ trans('vendors.views.edit.application.description') }}</p>@endif
        </div>
        @include('admin.vendors._form')
		<div class="panel-footer">
			<div class="row">
				<div class="col-xs-12 col-md-9 col-md-offset-3">
					<a href="{{ route('home') }}" class="btn btn-danger">{{ trans('actions.cancel') }}</a>

					<a href="#" class="btn btn-default pull-right" v-if="!last_tab" v-on:click="next">{{ trans('actions.next') }}</a>
					<input name="submit" type="submit" class="btn bg-success pull-right" value="{{ trans('vendors.views._form.submit_application') }}" v-show="last_tab">
					<input type="submit" name="save" class="btn bg-blue-700 pull-right" value="{{ trans('actions.save') }}">
				</div>
			</div>
		</div>
    {!! Former::close() !!}
@endsection
