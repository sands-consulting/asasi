@extends('layouts.app')

@section('page-title', implode(' | ', [
	$transaction->invoice_number ?: $transaction->transaction_number,
	trans('transactions.title')
]))

@section('header')
<div class="page-title">
	<h4>
		{{ link_to_route('admin.transactions.index', trans('transactions.title')) }} /
		{{ ($transaction->invoice_number ?: $transaction->transaction_number) }}
</div>
<div class="heading-elements">
	<div class="heading-btn-group">
        <a href="{{ route('admin.transactions.index' )}}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class=" icon-undo2"></i> <span>{{ trans('actions.back') }}</span>
        </a>
    </div>
</div>
@endsection

@section('content')
@if($transaction->status == 'paid')
@include('admin.transactions.invoice')
@else
@include('admin.transactions.statement')
@endif
@endsection
