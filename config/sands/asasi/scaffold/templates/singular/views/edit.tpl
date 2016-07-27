@extends('layouts.admin')

@section('header')
<div class="page-title">
    <h4>
        {{ link_to_route('admin.model-names.index', trans('model-names.views.create.title')) }} /
        <span class="text-semibold">{{ trans('model-names.buttons.create') }}</span>
    </h4>
</div>
<div class="heading-elements">
    <div class="heading-btn-group">
        <a href="{{ route('admin.model-names.index') }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class=" icon-undo2"></i> <span>{{ trans('model-names.buttons.all') }}</span>
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
    <div class="panel-body">
        {!! Former::open(action('Admin\ModelNamesController@store'))->method('POST') !!}
            {!! Former::populate($model-name) !!}
            @include('admin.model-names.form')
        {!! Former::close() !!}
    </div>
</div>
@endsection