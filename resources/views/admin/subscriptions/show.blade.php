@extends('layouts.admin')

@section('header')
<div class="page-title">
    <h4>
        {{ link_to_route('admin.subscriptions.index', trans('subscriptions.title')) }} /
        <span class="text-semibold">{{ $subscription->number }}</span>
    </h4>
</div>
<div class="heading-elements">
    <div class="heading-btn-group">
        @can('activate', $subscription)
        <a href="{{ route('admin.subscriptions.activate', $subscription->id) }}" data-method="PUT" class="btn btn-link btn-float text-size-small has-text text-blue legitRipple">
            <i class="icon-check"></i> <span>{{ trans('actions.activate') }}</span>
        </a>
        @endcan

        
        @can('cancel', $subscription)
         <a href="#" class="btn btn-link btn-float text-size-small has-text text-warning legitRipple" data-toggle="modal" data-target="#cancel-modal">
            <i class="icon-cancel-circle2"></i> <span>{{ trans('actions.cancel') }}</span>
        </a>
        @endcan

        @can('edit', $subscription)
        <a href="{{ route('admin.subscriptions.edit', $subscription->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class="icon-pencil5"></i> <span>{{ trans('subscriptions.buttons.edit') }}</span>
        </a>
        @endcan

        @can('destroy', $subscription)
        <a href="{{ route('admin.subscriptions.destroy', $subscription->id) }}" data-method="DELETE" class="btn btn-link btn-float text-size-small has-text text-warning legitRipple" data-confirm="{{ trans('app.confirmation') }}">
            <i class="icon-trash"></i> <span>{{ trans('actions.delete') }}</span>
        </a>
        @endcan

        <a href="{{ route('admin.subscriptions.index') }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class=" icon-undo2"></i> <span>{{ trans('actions.back') }}</span>
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading"><h4 class="panel-title">{{ trans('subscriptions.views.admin.show.subscriber.title') }}</h4></div>
            <table class="table table-bordered">
                <tr>
                    <th>{{ trans('subscriptions.views.admin.show.subscriber.name') }}</th>
                    <td>{{ $subscription->subscriber->name}}</td>
                </tr>
                <tr>
                    <th>{{ trans('subscriptions.views.admin.show.subscriber.address') }}</th>
                    <td>
                        @if($subscription->subscriber->address)
                        @if($subscription->subscriber->address->line_one){{ $subscription->subscriber->address->line_one }}<br>@endif
                        @if($subscription->subscriber->address->line_two){{ $subscription->subscriber->address->line_two }}<br>@endif

                        @if($subscription->subscriber->address->postcode){{ $subscription->subscriber->address->postcode }}
                            @if($subscription->subscriber->address->city){{ $subscription->subscriber->address->city->name }}@endif
                            <br>
                        @endif

                        @if($subscription->subscriber->address->state){{ $subscription->subscriber->address->state->name }}<br>@endif
                        @if($subscription->subscriber->address->country){{ $subscription->subscriber->address->country->name }}@endif
                        @else
                        {{ blank_icon(null) }}
                        @endif
                    </td>
                </tr>
            </table>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading"><h4 class="panel-title">{{ trans('subscriptions.views.admin.show.package.title') }}</h4></div>
            <table class="table table-bordered">
                <tr>
                    <th>{{ trans('packages.attributes.name') }}</th>
                    <td>{{ $subscription->package->name }}</td>
                </tr>
                <tr>
                    <th>{{ trans('packages.attributes.fee') }}</th>
                    <td>{{ setting('currency') }} {{ $subscription->package->fee }}</td>
                </tr>
                <tr>
                    <th>{{ trans('packages.attributes.tax_code') }}</th>
                    <td>{{ $subscription->package->taxCode->rate }}% ({{ $subscription->package->taxCode->code }})</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="col-xs-12 col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading"><h4 class="panel-title">{{ trans('subscriptions.views.admin.show.subscription.title') }}</h4></div>
            <table class="table table-bordered">
                <tr>
                    <th>{{ trans('subscriptions.attributes.number') }}</th>
                    <td>{{ $subscription->number }}</td>
                </tr>
                <tr>
                    <th>{{ trans('subscriptions.attributes.start_at') }}</th>
                    <td>{{ $subscription->start_at->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <th>{{ trans('subscriptions.attributes.end_at') }}</th>
                    <td>{{ $subscription->end_at->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <th>{{ trans('subscriptions.attributes.status') }}</th>
                    <td>@include('admin.subscriptions.index.status')</td>
                </tr>
            </table>
        </div>
    </div>
</div>

@include('admin.subscriptions.modals.cancel')
@endsection
