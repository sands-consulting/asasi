@extends('layouts.app')

@section('header')
<div class="page-title">
    <h4>{{ trans('subscriptions.title') }}</h4>
</div>
<div class="heading-elements">
    <div class="heading-btn-group">
        <a href="{{ route('admin.subscriptions.create') }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class=" icon-plus-circle2"></i> <span>{{ trans('subscriptions.buttons.create') }}</span>
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
    <div class="panel-body form-datatable-search form-inline">
        <input type="text" name="q[keywords]" class="form-control input-sm" placeholder="{{ trans('subscriptions.views.admin.index.keywords') }}" v-model="q.keywords">
        <select name="q[status]" class="form-control input-sm" v-model="q.status">
            <option value="" selected="selected">{{ trans('subscriptions.views.admin.index.status') }}</option>
            @foreach(collect(trans('statuses'))->only('active', 'inactive') as $key => $value)<option value="{{ $key }}">{{ $value }}</option>@endforeach
        </select>
        <a href="#" class="btn btn-sm btn-primary" v-on:click="perform_search">{{ trans('actions.search') }}</a>
        <a href="#" class="btn btn-sm btn-default" v-show="searching" v-on:click="clear_search">{{ trans('actions.clear') }}</a>
    </div>
</div>

<div class="panel panel-flat">
    {!! $dataTable->table() !!}
</div>
@endsection

@section('scripts')
{!! $dataTable->scripts() !!}
@endsection