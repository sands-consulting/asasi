@extends('layouts.portal')

@section('content')
<div id="cart" class="panel panel-default" v-cloak>
    <div class="panel-heading">
        <h5 class="panel-title pull-left">{{ trans('cart.title') }}</h5>
        <a href="{{ route('cart') }}" class="text-danger pull-right" data-method="DELETE" v-if="!payment">
            <i class="icon-trash"></i>
        </a>
        <div class="clearfix"></div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th class="col-xs-1"></th>
                <th class="col-xs-2 text-left">{{ trans('cart.attributes.item') }}</th>
                <th class="col-xs-2 text-right">{{ trans('cart.attributes.price') }}</th>
                <th class="col-xs-2 text-right">{{ trans('cart.attributes.tax') }}</th>
                <th class="col-xs-2 text-right">{{ trans('cart.attributes.total') }}</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in items">
                <td width="5%">
                    <a v-bind:href="'/cart/remove/' +item.id" class="text-danger" data-method="DELETE" data-confirm="{{ trans('app.confirmation') }}" v-if="!payment"><i class="icon-cross3"></i></a>
                </td>
                <td width="20%">
                    <strong>@{{ item.organization.name }}</strong> <span class="text-light">@{{ item.number }}</span><br>
                    @{{ item.name }}
                </td>
                <td class="text-right">
                    {{ setting('currency') }} @{{ item.price.format('0,0.00') }}
                </td>
                <td class="text-right">
                    {{ setting('currency') }} @{{ item.tax.format('0,0.00') }}
                    <template v-if="item.tax_code"><br><small>@{{ item.tax_code.rate }}% (@{{ item.tax_code.code }})</small></template>
                </td>
                <td class="text-right">
                    {{ setting('currency') }} @{{ item.total.format('0,0.00') }}
                </td>
            </tr>
            <tr v-if="items.length > 0">
                <td colspan="4" class="text-right">{{ trans('cart.attributes.sub_total') }}</td>
                <td class="text-right">{{ setting('currency') }} @{{ subTotal.format('0,0.00') }}</td>
            </tr>
            <tr v-if="items.length > 0">
                <td colspan="4" class="text-right">{{ trans('cart.attributes.tax') }}</td>
                <td class="text-right">{{ setting('currency') }} @{{ tax.format('0,0.00') }}</td>
            </tr>
            <tr v-if="items.length > 0">
                <td colspan="4" class="text-right">{{ trans('cart.attributes.total') }}</td>
                <td class="text-right">{{ setting('currency') }} @{{ total.format('0,0.00') }}</td>
            </tr>
            <tr v-if="items.length == 0">
                <td colspan="5">
                    <p class="text-center">{{ trans('cart.views.index.empty') }}</p>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="panel-footer">
        <a href="#" class="btn btn-link text-danger" @click.prevent="cancelCheckout" v-if="payment">
            {{ trans('actions.cancel') }}
        </a>

        <a href="#" class="btn bg-blue-700 pull-right" @click.prevent="checkout" v-if="!payment">
            {{ trans('actions.checkout') }} <i class="icon-arrow-right14 position-right"></i>
        </a>

        <form method="POST" action="{{ route('cart') }}" class="pull-right" v-if="payment">
            {{ csrf_field() }}
            <select name="gateway_id" class="form-control" v-model="gatewayId">
                <option value="" selected="selected" disabled>{{ trans('cart.views.index.select-gateway') }}</option>
                <option v-for="gateway in gateways" v-bind:value="gateway.id">@{{ gateway.label }}</option>
            </select>
            <input type="submit" value="{{ trans('cart.views.index.pay-now') }}" class="btn btn-block btn-sm bg-blue-700" v-if="gatewayId > 0">
        </form>
    </div>
</div>
@stop
