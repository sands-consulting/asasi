@extends('layouts.app')

@section('content')
@include('layouts.app.widgets.wizard')

<div class="panel panel-transaction">
    <div class="panel-heading bg-danger">
    	<h4 class="panel-title">{{ trans('transactions.views.error.title') }}</h4>
    </div>
    <div class="panel-body">
    	{{ session('message') }}
    </div>
    @if(isset($transaction))
    @include('admin.transactions.transaction')
    @endif
</div>
@stop
