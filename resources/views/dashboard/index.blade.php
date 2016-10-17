@extends('layouts.public')

@section('content')
{!! $dataTable->table(['class' => 'table table-bordered table-condensed']) !!}
@endsection

@section('scripts')
{!! $dataTable->scripts() !!}
@endsection