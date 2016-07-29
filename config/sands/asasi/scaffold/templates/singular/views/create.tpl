@extends('layouts.admin')

@section('page-title', implode(' | ', [
    trans('model-names.views.create.title'),
    trans('model-names.title')
]))

@section('header')
<div class="page-title">
    <h4>
        {{ link_to_route('admin.model-names.index', trans('model-names.title')) }} /
        <span class="text-semibold">{{ trans('model-names.views.create.title') }}</span>
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
        {!! Former::open(route('admin.model-names.index'))->method('POST') !!}
            {!! Former::populate($modelName) !!}
            @include('admin.model-names.form')
        {!! Former::close() !!}
    </div>
</div>
@endsection