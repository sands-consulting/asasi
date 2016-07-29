@extends('layouts.admin')

@section('page-title', trans('model-names.title'))

@section('header')
<div class="page-title">
    <h4>{{ trans('model-names.title') }}</h4>
</div>
@if(Auth::user()->hasPermission('model-name:create'))
<div class="heading-elements">
    <div class="heading-btn-group">
        <a href="{{ route('admin.model-names.create') }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class="icon-plus-circle2"></i> <span>{{ trans('model-names.buttons.create') }}</span>
        </a>
    </div>
</div>
@endif
@endsection

@section('content')
<div class="panel panel-flat">
    <div class="panel-body form-datatable-search form-inline">
        <input type="text" name="q[keywords]" class="form-control input-sm" placeholder="{{ trans('model-names.views.index.keywords') }}" v-model="q.keywords">
        <select name="q[type]" class="form-control input-sm" v-model="q.type">
            <option value="" selected="selected">{{ trans('model-names.views.index.type') }}</option>
            @foreach(\App\Place::$types as $type)<option value="{{ $type }}">{{ trans('model-names.types.' . $type) }}</option>@endforeach
        </select>
        <select name="q[status]" class="form-control input-sm" v-model="q.status">
            <option value="" selected="selected">{{ trans('model-names.views.index.status') }}</option>
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