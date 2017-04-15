@extends('layouts.portal')

@section('content')
<div id="cart" class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="panel-title">{{ trans('cart.title') }}</h5>
            </div>
        </div>
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
                    <a v-bind:href="'/cart/remove/' +item.id" class="text-danger" data-method="DELETE" data-confirm="{{ trans('app.confirmation') }}"><i class="icon-cross3"></i></a>
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
        <a href="{{ route('cart') }}" class="btn btn-link text-danger" data-method="DELETE">
            <i class="icon-trash"></i>
        </a>
        <a href="{{ route('cart') }}" class="btn bg-blue-700 pull-right" data-method="POST">
            {{ trans('actions.checkout') }} <i class="icon-arrow-right14 position-right"></i>
        </a> 
    </div>
</div>
@stop
