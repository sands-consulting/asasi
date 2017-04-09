@extends('layouts.admin')

@section('header')
<div class="page-title">
    <h4>
        {{ link_to_route('admin.payment-gateways.index', trans('payment-gateways.title')) }} /
        <span class="text-semibold">{{ $gateway->name }}</span>
    </h4>
</div>
<div class="heading-elements">
    <div class="heading-btn-group">
        @can('destroy', $gateway)
            <a href="{{ route('admin.payment-gateways.destroy', $gateway->id) }}"
               class="btn btn-link btn-float text-size-small has-text legitRipple text-danger" data-method="DELETE">
                <i class=" icon-trash"></i> <span>{{ trans('actions.delete') }}</span>
            </a>
        @endcan
        <a href="{{ route('admin.payment-gateways.index') }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class=" icon-undo2"></i> <span>{{ trans('actions.back') }}</span>
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
    <div class="panel-body">
        {!! Former::open(route('admin.payment-gateways.update', $gateway->id))->method('PUT') !!}
            {!! Former::populate($gateway) !!}
            @include('admin.payment-gateways.form')
        {!! Former::close() !!}
    </div>
</div>
@endsection