@extends('layouts.admin')

@section('header')
<div class="page-title">
    <h4>
        {{ link_to_route('admin.gateways.index', trans('payment-gateways.title')) }} /
        <span class="text-semibold">{{ trans('payment-gateways.views.create.title') }}</span>
    </h4>
</div>
<div class="heading-elements">
    <div class="heading-btn-group">
        <a href="{{ route('admin.gateways.index') }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class=" icon-undo2"></i> <span>{{ trans('actions.back') }}</span>
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
    <div class="panel-body">
        {!! Former::open(route('admin.payment-gateways.index'))->method('POST') !!}
            @include('admin.payment-gateways.form')
        {!! Former::close() !!}
    </div>
</div>
@endsection