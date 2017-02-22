@extends('layouts.portal')

@section('content')
<div class="page-container">
    <div class="page-content">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h5 class="panel-title">{{ trans('carts.title') }}</h5>
                                </div>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Price</th>
                                                <th>Tax</th>
                                                <th>Quantity</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (Cart::count() > 0 )
                                                @foreach($contents as $item)
                                                    <tr>
                                                        <td width="5%"><a href="{{ route('carts.remove', $item->rowId) }}" data-method="POST" data-confirm="{{ trans('app.confirmation') }}"><i class="icon-cross3"></i></a></td>
                                                        <td width="20%">{{ $item->name }}</td>
                                                        <td><small>{{ $item->options->description }}</small></td>
                                                        <td>{{ $item->price }}</td>
                                                        <td>{{ $item->tax }}</td>
                                                        <td>{{ $item->qty }}</td>
                                                        <td>{{ $item->subtotal }}</td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="3">Total</td>
                                                    <td>{{ Cart::subtotal() }}</td>
                                                    <td>{{ Cart::tax() }}</td>
                                                    <td>{{ Cart::count() }}</td>
                                                    <td>{{ Cart::total() }}</td>
                                                </tr>
                                            @else
                                                <tr>
                                                    <td colspan="7">
                                                        <p class="text-center">{{ trans('carts.views.index.empty') }}</p>
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="panel-footer">
                            <div class="heading-elements">
                                <a href="{{ route('cart') }}" class="heading-text text-default pull-right" data-method="POST">{{ trans('actions.checkout') }} <i class="icon-arrow-right14 position-right"></i></a> 
                            </div>
                            <a class="heading-elements-toggle"><i class="icon-more"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
