@extends('vendors.layout')

@section('inner')
<div class="panel panel-flat">
    {!! $dataTable->table() !!}
</div>
@endsection

@section('scripts')
{!! $dataTable->scripts() !!}
@endsection