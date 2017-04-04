@extends('layouts.portal')

@section('ahead')
    @include('layouts.portal.aheads.public')
@endsection

@section('content')
@include('layouts.menu.portal')

<div class="panel panel-flat">
    {!! $dataTable->table() !!}
</div>
@endsection

@section('scripts')
{!! $dataTable->scripts() !!}
@endsection