@extends('layouts.admin')

@section('header')
<div class="page-title">
    <h4>{{ trans('notice-categories.views.index.title') }}</h4>
</div>
<div class="heading-elements">
    <div class="heading-btn-group">
        <a href="{{ route('admin.notice-categories.create') }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class=" icon-user-plus"></i> <span>{{ trans('notice-categories.buttons.create') }}</span>
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
    <div class="panel-body form-datatable-search form-inline">
        <input type="text" name="q[keywords]" class="form-control input-sm" placeholder="{{ trans('notice-categories.views.index.keywords') }}" v-model="q.keywords">
        <select name="q[status]" class="form-control input-sm" v-model="q.status">
            <option value="" selected="selected">{{ trans('notice-categories.views.index.status') }}</option>
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