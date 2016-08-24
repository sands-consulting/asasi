@extends('layouts.admin')

@section('header')
<div class="page-title">
    <h4>
        {{ link_to_route('admin.notice-types.index', trans('notice-types.views.index.title')) }} /
        <span class="text-semibold">{{ trans('notice-types.views.edit.title') }}</span>
    </h4>
</div>
<div class="heading-elements">
    <div class="heading-btn-group">
        <a href="{{ route('admin.notice-types.index') }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class=" icon-undo2"></i> <span>{{ trans('actions.back') }}</span>
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
    <div class="panel-body">
        {!! Former::open(route('admin.notice-types.show', $noticeType->id))->method('PUT') !!}
            {!! Former::populate($noticeType) !!}
            @include('admin.notice-types.form')
            <div class="form-group">
                <div class="col-lg-10 col-sm-8 col-lg-offset-2 col-sm-offset-4">
                    {!! Former::submit(trans('actions.save'))->addClass('bg-blue')->data_confirm(trans('app.confirmation')) !!}
                    {!! link_to_route('admin.notice-types.index', trans('actions.cancel'), [], ['class' => 'btn btn-default']) !!}
                </div>
            </div>
        {!! Former::close() !!}
    </div>
</div>
@endsection