<div class="panel panel-flat">
	<div class="panel-heading">
		<h4 class="panel-title">{{ trans('transactions.views.admin.invoice.title') }}</h4>
	</div>

	<div class="panel-body panel-transaction">
		<div class="row header">
			<div class="col-xs-6 panel-invoice">
				<div class="heading">{{ trans('transactions.views.admin.invoice.payer') }}</div>
				<strong>{{ $transaction->payer->name }}</strong><br>
				{{ $transaction->payer->address->line_one }}<br>
				@if($transaction->payer->address->line_two){{ $transaction->payer->address->line_two }}<br>@endif
				@if($transaction->payer->address->postcode)
					{{ $transaction->payer->address->postcode }}
					@if($transaction->payer->address->city){{ $transaction->payer->address->city->name }}@endif
					<br>
				@endif
				@if($transaction->payer->address->state){{ $transaction->payer->address->state->name }}<br>@endif
				@if($transaction->payer->address->country){{ $transaction->payer->address->country->name }}@endif
			</div>

			<div class="col-xs-6">
				<table class="table table-bordered table-transaction">
					<tr>
						<th>{{ trans('transactions.attributes.invoice_number') }}</th>
						<td>{{ $transaction->invoice_number }}</td>
					</tr>
					<tr>
						<th>{{ trans('transactions.attributes.created_at') }}</th>
						<td>{{ $transaction->created_at->format('d/m/Y H:i:s') }}</td>
					</tr>
					<tr>
						<th>{{ trans('transactions.attributes.transaction_number') }}</th>
						<td>{{ $transaction->transaction_number }}</td>
					</tr>
				</table>
			</div>
		</div>

		<table class="table table-bordered table-lines table-vtop">
			<thead>
				<th>#</th>
				<th>{{ trans('transactions.attributes.item') }}</th>
				<th class="text-right">{{ trans('transactions.attributes.price') }}<br>({{ setting('currency') }})</th>
				<th class="text-right">{{ trans('transactions.attributes.tax') }}<br>({{ setting('currency') }})</th>
				<th class="text-right">{{ trans('transactions.attributes.total') }}<br>({{ setting('currency') }})</th>
			</thead>
			<tbody>
				@foreach($transaction->lines as $line)
				<tr>
					<td>{{ $loop->iteration }}</td>
					<td>{!! nl2br($line->description) !!}</td>
					<td class="text-right">{{ $line->price }}</td>
					<td class="text-right">{{ $line->tax }}<br><small>{{ $line->tax_rate }}% ({{ $line->tax_code }})</small></td>
					<td class="text-right">{{ $line->total }}</td>
				</tr>
				@endforeach
			</tbody>
			<tfoot>
				<tr>
					<th class="text-right" colspan="4">{{ trans('transactions.attributes.sub_total') }}</th>
					<td class="text-right">{{ $transaction->sub_total }}</td>
				</tr>
				<tr>
					<th class="text-right" colspan="4">{{ trans('transactions.attributes.tax') }}</th>
					<td class="text-right">{{ $transaction->tax }}</td>
				</tr>
				<tr?
					<th class="text-right" colspan="4">{{ trans('transactions.attributes.total') }}</th>
					<td class="text-right">{{ $transaction->total }}</td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>
