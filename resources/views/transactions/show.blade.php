@extends('layouts.portal')

@section('content')
@include('layouts.portal.widgets.wizard')

<div class="panel {{ $transaction->status == 'paid' ? 'panel-success' : 'panel-warning' }}">
    <div class="panel-heading">
    	<h4 class="panel-title">{{ trans('transactions.views.show.title') }}</h4>
    </div>
    @if(session('message'))
    <div class="panel-body bg-warning-300">
    	{{ session('message') }}
    </div>
    @endif
    @if(isset($transaction))
    @include('admin.transactions.transaction')
    @endif
</div>
@stop
