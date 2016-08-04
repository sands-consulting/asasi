@extends('layouts.public')

@section('content')
<div class="page-container">
    <div class="page-content">
    	<div class="content-wrapper">
    		<div class="row">
    			<div class="col-xs-12 col-sm-12">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h4 class="panel-title">{{ trans('subscriptions.views.index.public.title') }}</h4>
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label"><strong>{{ trans('subscriptions.attributes.name') }}</strong>:</label>
                                        <div class="form-control-static">{{ $subscription->package->name }}</div>
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
                                        <div class="form-control-static">{{ $subscription->started_at->format('m/d/Y') }}</div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label"><strong>{{ trans('subscriptions.attributes.expired_at') }}</strong>:</label>
                                        <div class="form-control-static">{{ $subscription->expired_at->format('m/d/Y') }}  - {{ $subscription->expired_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
    </div>
</div>
@stop
