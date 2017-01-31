@extends('layouts.public')

@section('header')
    <div class="page-title">
        <h4><i class="icon-envelop5 position-left"></i> <span class="text-semibold">{{ trans('subscriptions.views.current.title') }}</span></h4>

        <ul class="breadcrumb breadcrumb-caret position-right">
            <li><a href="{{ route('contact') }}">Home</a></li>
            <li class="active">Subscriptions</li>
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
                    <h4 class="panel-title">{{ trans('subscriptions.views.index.public.details') }}</h4>
                </div>

                <div class="panel-body">
                    @if ($subscription)
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label"><strong>{{ trans('subscriptions.attributes.name') }}</strong>:</label>
                                <div class="form-control-static">{{ $subscription->package ? $subscription->package->name: 'No' }}</div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label"><strong>{{ trans('subscriptions.attributes.status') }}</strong>:</label>
                                <div class="form-control-static">
                                    @if($subscription->status == 'active')
                                    <span class="label label-success">
                                    @elseif($subscription->status == 'suspended')
                                    <span class="label label-danger">
                                    @else
                                    <span class="label label-default">
                                    @endif
                                    {{ trans('statuses.' . $subscription->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label"><strong>{{ trans('subscriptions.attributes.started_at') }}</strong>:</label>
                                <div class="form-control-static">{{ $subscription->started_at->formatDateFromSetting() }}</div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label"><strong>{{ trans('subscriptions.attributes.expired_at') }}</strong>:</label>
                                <div class="form-control-static">{{ $subscription->expired_at->formatDateFromSetting() }}</div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-control-static">{{ trans('subscriptions.views.current.no-subscription') }}</div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
    	</div>
    </div>
@stop
