<div class="panel-body panel-transaction">
	<div class="row">
		<div class="col-xs-12 col-md-8">
			<table class="table table-bordered table-lines">
				<thead>
					<th>#</th>
					<th>{{ trans('transactions.attributes.item') }}</th>
					<th>{{ trans('transactions.attributes.price') }}<br>({{ setting('currency') }})</th>
					<th>{{ trans('transactions.attributes.tax') }}<br>({{ setting('currency') }})</th>
					<th>{{ trans('transactions.attributes.total') }}<br>({{ setting('currency') }})</th>
				</thead>
				<tbody>
					@foreach($transaction->lines as $line)
					<tr>
						<td>{{ $loop->iteration }}</td>
						<td>{!! nl2br($line->description) !!}</td>
						<td>{{ $line->price }}</td>
						<td>{{ $line->tax }}<br><small>{{ $line->tax_rate }}% ({{ $line->tax_code }})</small></td>
						<td>{{ $line->total }}</td>
					</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<th class="text-right" colspan="4">{{ trans('transactions.attributes.sub_total') }}</th>
						<td>{{ $transaction->sub_total }}</td>
					</tr>
					<tr>
						<th class="text-right" colspan="4">{{ trans('transactions.attributes.tax') }}</th>
						<td>{{ $transaction->sub_total }}</td>
					</tr>
					<tr>
						<th class="text-right" colspan="4">{{ trans('transactions.attributes.total') }}</th>
						<td>{{ $transaction->sub_total }}</td>
					</tr>
				</tfoot>
			</table>

			@if($transaction->status == 'paid')
			<a href="{{ route('transactions.invoice', $transaction->id) }}" class="btn btn-xs bg-blue-700" target="_blank">{{ trans('transactions.buttons.download-invoice') }}</a>
			@else
			<a href="{{ route('transactions.statement', $transaction->id) }}" class="btn btn-xs btn-default" target="_blank">{{ trans('transactions.buttons.download-statement') }}</a>
			@endif
		</div>

		<div class="col-xs-12 col-md-4">
			<div class="list-group list-transaction">
				<a href="#" class="list-group-item list-header">{{ trans('transactions.attributes.status') }}</a>
  				<a href="#" class="list-group-item">{{ trans('statuses.' . $transaction->status) }}</a>

  				<a href="#" class="list-group-item list-header">{{ trans('transactions.attributes.transaction_number') }}</a>
  				<a href="#" class="list-group-item">{{ $transaction->transaction_number }}</a>

  				<a href="#" class="list-group-item list-header">{{ trans('transactions.attributes.created_at') }}</a>
  				<a href="#" class="list-group-item">{{ $transaction->created_at->format('d/m/Y H:i:s') }}</a>

  				@if($transaction->status == 'paid')
  				<a href="#" class="list-group-item list-header">{{ trans('transactions.attributes.invoice_number') }}</a>
  				<a href="#" class="list-group-item">{{ $transaction->invoice_number }}</a>

  				<a href="#" class="list-group-item list-header">{{ trans('transactions.attributes.paid_at') }}</a>
  				<a href="#" class="list-group-item">{{ $transaction->paid_at->format('d/m/Y H:i:s') }}</a>
  				@endif

  				@if($transaction->gateway)
  				<a href="#" class="list-group-item list-header">{{ trans('transactions.attributes.gateway') }}</a>
  				<a href="#" class="list-group-item">{{ $transaction->gateway->label }}</a>
  				@endif
  			</div>

  		</div>
  	</div>
</div>
