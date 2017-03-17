@extends('layouts.portal')

@section('content')
<div class="page-container">
    <div class="page-content">
        <div class="content-wrapper">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5 class="panel-title">{{ trans('subscriptions.views.create.title') }}</h5>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>{{ trans('subscriptions.views.create.package.name') }}</th>
                            <th class="text-right">{{ trans('subscriptions.views.create.package.fee') }}</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($packages as $package)
                        <tr>
                            <th>
                                {{ $package->name }}<br>
                                <small>{{ $package->validity_quantity }} {{ $package->validity_type }}</small>
                            </th>
                            <td class="text-right">
                                RM {{ $package->fee_amount }}<br>
                                <small>+ {{ floatval($package->fee_tax_rate) }}% ({{ $package->fee_tax_code }})</small>
                            </td>
                            <td></td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
