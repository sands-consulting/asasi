@extends('layouts.admin')

@section('header')
<div class="page-title">
	<h4>{{ trans('vendors.title') }}</h4>
</div>
<div class="heading-elements">
	<div class="heading-btn-group">
		<a href="{{ route('admin.vendors.create') }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class="icon-plus-circle2"></i>  <span>{{ trans('vendors.buttons.create') }}</span>
		</a>
	</div>
</div>
@endsection

@section('content')
<div class="datatable-filter">
    <div class="row">
        <div class="col-xs-12 col-md-2">
            <a href="#" @click.prevent="handle_dashboard($event)" 
                class="prompt-box bg-white border border-bottom-primary" 
                data-filter="all"
                data-color="primary">
                <div class="title">All</div>
                <div class="number text-primary">{{ App\Vendor::count() }}</div>
            </a>
        </div>
        <div class="col-xs-12 col-md-2">
            <a href="#" @click.prevent="handle_dashboard($event)" 
                class="prompt-box bg-white border border-bottom-grey" 
                data-filter="active"
                data-color="grey">
                <div class="title">Draft</div>
                <div class="number text-grey">{{ App\Vendor::draft()->count() }}</div>
            </a>
        </div>
        <div class="col-xs-12 col-md-2">
            <a href="#" @click.prevent="handle_dashboard($event)" 
                class="prompt-box bg-white border border-bottom-success" 
                data-filter="active"
                data-color="success">
                <div class="title">Active</div>
                <div class="number text-success">{{ App\Vendor::active()->count() }}</div>
            </a>
        </div>
        <div class="col-xs-12 col-md-2">
            <a href="#" @click.prevent="handle_dashboard($event)" 
                class="prompt-box bg-white border border-bottom-warning" 
                data-filter="inactive"
                data-color="warning">
                <div class="title">Inactive</div>
                <div class="number text-warning">{{ App\Vendor::inactive()->count() }}</div>
            </a>
        </div>
        <div class="col-xs-12 col-md-2">
            <a href="#" @click.prevent="handle_dashboard($event)" 
                class="prompt-box bg-white border border-bottom-danger" 
                data-filter="blacklisted"
                data-color="danger">
                <div class="title">Rejected</div>
                <div class="number text-danger">{{ App\Vendor::rejected()->count() }}</div>
            </a>
        </div>
        <div class="col-xs-12 col-md-2">
            <a href="#" @click.prevent="handle_dashboard($event)" 
                class="prompt-box bg-white border border-bottom-default" 
                data-filter="blacklisted"
                data-color="default">
                <div class="title">Blacklisted</div>
                <div class="number text-default">{{ App\Vendor::blacklisted()->count() }}</div>
            </a>
        </div>
    </div>
</div>

{{-- <div class="panel panel-flat">
	<div class="panel-body form-datatable-search form-inline">
		<input type="text" name="q[keywords]" class="form-control input-sm" placeholder="{{ trans('vendors.views.index.keywords') }}" v-model="q.keywords">
		<select name="q[status]" class="form-control input-sm" v-model="q.status">
			<option value="" selected="selected">{{ trans('vendors.views.index.status') }}</option>
			@foreach(collect(trans('statuses'))->only('pending-confirmation', 'confirmed','suspended') as $key => $value)<option value="{{ $key }}">{{ $value }}</option>@endforeach
		</select>
		<a href="#" class="btn btn-sm btn-primary" v-on:click="perform_search">{{ trans('actions.search') }}</a>
		<a href="#" class="btn btn-sm btn-default" v-show="searching" v-on:click="clear_search">{{ trans('actions.clear') }}</a>
	</div>
</div> --}}

<div class="panel panel-flat">
	{!! $dataTable->table() !!}
</div>
@endsection

@section('scripts')
{!! $dataTable->scripts() !!}
@endsection