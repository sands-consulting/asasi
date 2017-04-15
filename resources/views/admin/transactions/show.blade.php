@extends('layouts.admin')

@section('page-title', implode(' | ', [
	$transaction->invoice_number || $transaction->transaction_number
	trans('transactions.title')
]))

@section('header')
<div class="page-title">
	<h4>
		{{ trans('transactions.title') }} / 
		{{ link_to_route('admin.transactions.show', $transaction->invoice_number || $transaction->transaction_number, $transaction->id) }}
</div>
<div class="heading-elements">
	<div class="heading-btn-group">
		@can('pay', $transaction)
		<a href="{{ route('admin.transactions.pay', $transaction->id) }}" data-method="PUT" class="btn btn-link btn-float text-size-small has-text text-blue legitRipple">
			<i class="icon-user-check"></i> <span>{{ trans('actions.pay') }}</span>
		</a>
		@endcan
		
		@can('cancel', $transaction)
		<a href="{{ route('admin.transactions.suspend', $user->id) }}" data-method="PUT" class="btn btn-link btn-float text-size-small has-text text-danger legitRipple">
			<i class="icon-user-block"></i> <span>{{ trans('actions.cancel') }}</span>
		</a>
		@endcan

		@can('destroy', $transaction)
		<a href="{{ route('admin.transactions.destroy', $user->id) }}" data-method="DELETE" class="btn btn-link btn-float text-size-small has-text text-danger legitRipple">
			<i class="icon-trash"></i> <span>{{ trans('actions.archive') }}</span>
		</a>
		@endcan
	</div>
</div>
@endsection

@section('content')
<div class="panel {{ $transaction->status == 'paid' ? 'panel-success' : 'panel-warning' }}">
    <div class="panel-heading">
    	<h4 class="panel-title">{{ trans('transactions.views.show.title') }}</h4>
    </div>
    @include('admin.transactions.transaction')
</div>
@endsection
