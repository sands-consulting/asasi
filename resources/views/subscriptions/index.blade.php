@extends('layouts.public')

@section('header')
    <div class="page-title">
        <h4><i class="icon-stack3 position-left"></i> <span class="text-semibold">{{ trans('subscriptions.views.index.public.title') }}</span></h4>

        <ul class="breadcrumb breadcrumb-caret position-right">
            <li><a href="{{ route('contact') }}">Home</a></li>
            <li class="active">{{ trans('subscriptions.views.index.public.title') }}</li>
        </ul>
    </div>

    <div class="heading-elements">
        <div class="heading-btn-group">
            <a href="{{ route('subscriptions.current') }}" class="btn btn-link btn-float has-text text-size-small legitRipple"><i class="icon-stack text-indigo-400"></i> <span>My Package</span></a>
            <a href="{{ route('subscriptions.history') }}" class="btn btn-link btn-float has-text text-size-small legitRipple"><i class="icon-history text-indigo-400"></i> <span>History</span></a>
        </div>
    </div>
    <a class="heading-elements-toggle"><i class="icon-more"></i></a>
@stop

@section('content')
    <div class="row">
        @foreach ($packages as $package)
        <div class="col-md-4">
            <div class="panel">
                <div class="panel-body text-center">
                    <div class="icon-object border-blue-400 text-blue"><i class="icon-stack3"></i></div>
                    <h5 class="text-semibold">{{ $package->name }} <br>
                        <small>{{ $package->validity_quantity }} {{ $package->validity_type }}</small> <br>
                        <small>RM {{ $package->fee_amount }}</small></h5>
                    <p class="mb-15">{{ $package->description }}</p>
                    <a href="{{ route('subscriptions.payment', $package->id) }}" class="btn bg-blue-400 legitRipple" data-method="POST">Subscribe</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@stop
