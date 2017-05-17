@extends('layouts.app')

@section('page-title', trans('transactions.title'))

@section('header')
<div class="page-title">
    <h4>{{ trans('transactions.title') }}</h4>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
    <div class="panel-body form-datatable-search form-inline">
        <input type="text" name="q[keywords]" class="form-control input-sm"
               placeholder="{{ trans('transactions.views.admin.index.search.keywords') }}" v-model="q.keywords">
        <select name="q[status]" class="form-control input-sm" v-model="q.status">
            <option value="">{{ trans('transactions.views.admin.index.search.status') }}</option>
            @foreach(collect(trans('statuses'))->only('pending', 'pending-authorization', 'cancelled', 'paid') as $key => $value)<option>{{ $value }}</option>@endforeach
        </select>
        <a href="#" class="btn btn-sm btn-primary" @click="perform_search">{{ trans('actions.search') }}</a>
        <a href="#" class="btn btn-sm btn-default" v-show="searching" @click="clear_search"
        >{{ trans('actions.clear') }}</a>
    </div>
</div>

<div class="panel panel-flat">
    {!! $dataTable->table() !!}
</div>
@endsection

@section('scripts')
    {!! $dataTable->scripts() !!}
@endsection