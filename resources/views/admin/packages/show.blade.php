@extends('layouts.admin')

@section('header')
<div class="page-title">
    <h4>
        {{ link_to_route('admin.packages.index', trans('packages.title')) }} /
        <span class="text-semibold">{{ trans('packages.views.show.title') }}</span>
    </h4>
</div>
<div class="heading-elements">
    <div class="heading-btn-group">
        @if($package->canActivate() && Auth::user()->hasPermission('package:activate'))
        <a href="{{ route('admin.packages.activate', $package->id) }}" data-method="PUT" class="btn btn-link btn-float text-size-small has-text text-blue legitRipple">
            <i class="icon-check"></i> <span>{{ trans('actions.activate') }}</span>
        </a>
        @endif

        @if($package->canDeactivate() && Auth::user()->hasPermission('package:deactivate'))
        <a href="{{ route('admin.packages.deactivate', $package->id) }}" data-method="PUT" class="btn btn-link btn-float text-size-small has-text text-warning legitRipple">
            <i class="icon-minus-circle2"></i> <span>{{ trans('actions.deactivate') }}</span>
        </a>
        @endif

        @if(Auth::user()->hasPermission('package:update'))
        <a href="{{ route('admin.packages.edit', $package->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class="icon-pencil5"></i> <span>{{ trans('packages.buttons.edit') }}</span>
        </a>
        @endif
    </div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">{{ trans('packages.views.show.title') }}: {{ $package->name }}</h5>
    </div>
    
    <div class="panel-body">
        <fieldset>
            <legend class="text-semibold">
                <i class="icon-file-text2 position-left"></i>
                Vendor Details
            </legend>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label"><strong>{{ trans('packages.attributes.name') }}</strong>:</label>
                        <div class="form-control-static">{{ $package->name }}</div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label"><strong>{{ trans('packages.attributes.validity_type') }}</strong>:</label>
                        <div class="form-control-static">{{ $package->validity_type }}</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label"><strong>{{ trans('packages.attributes.validity_quantity') }}</strong>:</label>
                        <div class="form-control-static">{{ $package->validity_quantity }}</div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label"><strong>{{ trans('packages.attributes.meta') }}</strong>:</label>
                        <div class="form-control-static">{{ $package->meta }}</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label"><strong>{{ trans('packages.attributes.fee_amount') }}</strong>:</label>
                        <div class="form-control-static">{{ $package->fee_amount }}</div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label"><strong>{{ trans('packages.attributes.fee_tax_code') }}</strong>:</label>
                        <div class="form-control-static">{{ $package->fee_tax_code }}</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label"><strong>{{ trans('packages.attributes.fee_tax_rate') }}</strong>:</label>
                        <div class="form-control-static">{{ $package->fee_tax_rate }}</div>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
</div>
@endsection
