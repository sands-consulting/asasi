@extends('layouts.portal')

@section('content')
@include('layouts.portal.aheads.vendor')

<div class="panel panel-notice">
    <div class="panel-heading bg-slate-600">
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