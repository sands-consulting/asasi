@extends('layouts.app')

@section('content')
@include('layouts.app.aheads.vendor')

<div class="panel panel-notice">
    <div class="panel-heading bg-violet-600">
        <h1 class="panel-title">{{ trans('me.views.bookmarks.title') }}</h1>
    </div>
    <div class="panel-body">
        {!! $dataTable->table() !!}
    </div>
</div>
@endsection

@section('scripts')
{!! $dataTable->scripts() !!}
@endsection