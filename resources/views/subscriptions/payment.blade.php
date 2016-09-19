@extends('layouts.public')

@section('header')
    <div class="page-title">
        <h4><i class="icon-stack3 position-left"></i> <span class="text-semibold">{{ trans('packages.views.payment.title') }}</span></h4>

        <ul class="breadcrumb breadcrumb-caret position-right">
            <li><a href="{{ route('home.index') }}">Home</a></li>
            <li><a href="{{ route('home.index') }}">Packages</a></li>
            <li class="active">Payment</li>
        </ul>
    </div>

    <div class="heading-elements">
        <div class="heading-btn-group">
            <a href="{{ route('subscriptions.history') }}" class="btn btn-link btn-float has-text text-size-small legitRipple"><i class="icon-history text-indigo-400"></i> <span>History</span></a>
            <a href="{{ route('subscriptions.index') }}" class="btn btn-link btn-float has-text text-size-small legitRipple"><i class="icon-stack3 text-indigo-400"></i> <span>Packages</span></a>
        </div>
    </div>
    <a class="heading-elements-toggle"><i class="icon-more"></i></a>
@stop

@section('content')
    <div class="row">
    	<div class="col-xs-12 col-sm-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h4 class="panel-title">{{ trans('packages.views.payment.summary') }}</h4>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label"><strong>{{ trans('packages.attributes.name') }}</strong>:</label>
                                <div class="form-control-static">{{ $package->name }}</div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label"><strong>{{ trans('packages.attributes.fee_amount') }}</strong>:</label>
                                <div class="form-control-static">{{ $package->fee_amount }}</div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label"><strong>{{ trans('packages.attributes.validity_quantity') }}</strong>:</label>
                                <div class="form-control-static">{{ $package->validity_quantity }} {{ $package->validity_type }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="heading-elements">
                        <a href="{{ route('subscriptions.endpoint', $package->id) }}" class="heading-text text-default pull-right" data-method="POST">{{ trans('actions.pay') }} <i class="icon-arrow-right14 position-right"></i></a> 
                    </div>
                    <a class="heading-elements-toggle"><i class="icon-more"></i></a>
                </div>
            </div>
    	</div>
    </div>
@stop
