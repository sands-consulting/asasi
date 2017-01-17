@extends('layouts.report')

@section('content')
<div class="page-header">
	<h1 class="pull-left">Vendor Reports - {{ trans('reports.vendor.r1.title') }} : {{ $date_start->format('d/m/Y') }} @if($date_end) - {{ $date_end->format('d/m/Y') }} @endif </h1>
	<a href="{{ route('reports.vendor.r1.excel', $params) }}" class="btn btn-xs btn-success pull-right">
		Download as XLS
	</a>
	<div class="clearfix"></div>
</div>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th class="col-xs-1">No.</th>
			<th>Status</th>
			<th class="col-xs-3">Count</th>
		</tr>
	</thead>
	<tbody>
		@php $i=1; @endphp
		@foreach($data as $row)
		<tr>
			<td>{{ $i }}</td>
			<th>{{ ucfirst($row->status) }}</th>
			<th>{{ $row->count }}</th>
		</tr>
		@php $i++; @endphp
		@endforeach
	</tbody>
	<tfoot>
		<tr>
			<td colspan="2">Total</td>
			<td>{{ $data->total }}</td>
		</tr>
	</tfoot>
</table>
@endsection