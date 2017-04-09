@extends('layouts.portal')

@section('content')
@include('layouts.portal.widgets.wizard')

<section id="form-subscription" v-cloak>
    <div class="panel panel-default" v-if="!selectedPackage">
        <div class="panel-heading">
            <h5 class="panel-title">{{ trans('subscriptions.views.create.packages.title') }}</h5>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>{{ trans('packages.attributes.name') }}</th>
                    <th class="text-right" width="150">{{ trans('packages.attributes.validity') }}</th>
                    <th class="text-right" width="150">{{ trans('packages.attributes.fee') }}</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(package, index) in packages">
                    <td>
                        <strong>@{{ package.name }}</strong><br>
                        <small>@{{ package.description }}</small>
                    </td>
                    <td class="text-right">
                        @{{ package.validity }}
                    </td>
                    <td class="text-right">
                        {{ setting('currency') }} @{{ package.fee }}<br>
                        <small>+ @{{ package.tax_code.rate }} (@{{ package.tax_code.code }})</small>
                    </td>
                    <td>
                        <a href="#" class="btn bg-blue-700 btn-xs" @click.prevent="selectPackage(package)">{{ trans('actions.select') }}</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="panel panel-default" v-if="selectedPackage">
        <div class="panel-heading">
            <h5 class="panel-title pull-left">{{ trans('subscriptions.views.create.confirmation.title') }}</h5>
            <a href="#" class="btn btn-xs bg-pink-700 pull-right" @click.prevent="cancelPackage">{{ trans('actions.cancel') }}</a>
            <div class="clearfix"></div>
        </div>
        <table class="table table-striped">
            <tr>
                <th width="200">{{ trans('packages.attributes.name') }}</th>
                <td>@{{ selectedPackage.name }}</td>
            </tr>
            <tr>
                <th>{{ trans('packages.attributes.validity') }}</th>
                <td>@{{ startDate.format('DD/MM/YYYY') }} - @{{ endDate.format('DD/MM/YYYY') }} (@{{ selectedPackage.validity }})</td>
            </tr>
            <tr>
                <th>{{ trans('subscriptions.views.create.confirmation.fee') }}</th>
                <td>{{ setting('currency') }} @{{ fee.format('0,0.00') }}</td>
            </tr>
            <tr>
                <th>{{ trans('subscriptions.views.create.confirmation.tax') }}</th>
                <td>
                    {{ setting('currency') }} @{{ tax.format('0,0.00') }}<br>
                    <small><em>+ @{{ selectedPackage.tax_code.rate }}% (@{{ selectedPackage.tax_code.code }})</em></small>
                </td>
            </tr>
            <tr>
                <th>{{ trans('subscriptions.views.create.confirmation.amount') }}</th>
                <td>{{ setting('currency') }} @{{ amount.format('0,0.00') }}</td>
            </tr>
            <tr>
                <th>{{ trans('subscriptions.views.create.confirmation.gateway') }}</th>
                <td>
                    <select name="gateway_id" class="form-control" v-model="gateway_id">
                        <option v-for="gateway in gateways" v-bind:value="gateway.id">@{{ gateway.label }}</option>
                    </select>
                </td>
            </tr>
            <tr v-if="gateway_id">
                <th>&nbpsp;</th>
                <td>
                    <form method="POST" action="{{ route('subscriptions.store') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="package_id" v-bind:value="selectedPackage.id">
                        <input type="hidden" name="gateway_id" v-bind:value="gateway_id">
                        <input type="submit" value="{{ trans('subscriptions.views.create.confirmation.pay-now') }}" class="btn btn-sm bg-blue-700">
                    </form>
                </td>
            </tr>
        </table>
    </div>
</section>
@endsection
