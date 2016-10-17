@extends('layouts.public')

@section('ahead')
@include('home._landing')
@endsection

@section('content')
<div class="panel panel-notice panel-grey">
    <div class="panel-heading">
        <h1 class="panel-title">{{ trans('home.views.index.notices.title') }}</h1>
    </div>
    <div class="panel-body">
        {!! $dataTable->table() !!}
    </div>
</div>
@endsection

@section('scripts')
{!! $dataTable->scripts() !!}
@endsection