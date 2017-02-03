@extends('layouts.admin')

@section('header')
<div class="page-title">
    <h4>
        {{ link_to_route('admin.notices.index', trans('notices.views.admin.index.title')) }} /
        <span class="text-semibold">{{ trans('notices.views.admin.create.title') }}</span>
    </h4>
</div>
<div class="heading-elements">
    <div class="heading-btn-group">
        <a href="{{ route('admin.notices.index') }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class=" icon-undo2"></i> <span>{{ trans('actions.back') }}</span>
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="panel panel-white">
    {!! Former::open_vertical(route('admin.notices.index'))->id('notice-form')->method('POST')->addClass('stepy-validation') !!}

        @include('admin.notices.form')

        <a href="{{ route('admin.notices.index') }}" class="btn bg-blue stepy-finish">{{ trans('actions.finish') }}</a>

    {!! Former::close() !!}
</div>
@endsection