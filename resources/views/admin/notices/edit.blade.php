@extends('layouts.admin')

@section('header')
<div class="page-title">
    <h4>
        {{ link_to_route('admin.notices.index', trans('notices.views.index.title')) }} /
        <span class="text-semibold">{{ trans('notices.views.edit.title') }}</span>
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
    {!! Former::open_vertical(route('admin.notices.index'))
        ->id('notice-form')
        ->method('POST')
        ->addClass('stepy-validation') !!}

        {{ Former::populate($notice) }}
        {!! Former::hidden('id', $notice->id)->id('noticeId') !!}

        @include('admin.notices.form')

        @include('admin.notices.form-requirement-commercials')

        @include('admin.notices.form-requirement-technicals')

        @include('admin.notices.form-notice-events')

        @include('admin.notices.form-others')
        
        {!! Former::submit(trans('actions.save'))
            ->addClass('bg-blue stepy-finish')
            ->data_confirm(trans('app.confirmation')) !!}

    {!! Former::close() !!}
</div>
@endsection