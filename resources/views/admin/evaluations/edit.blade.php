@extends('layouts.admin')

@section('page-title', trans('evaluations.vendors'))

@section('header')
<div class="page-title">
    <h4>
        {!! link_to_route('admin.evaluations.index', trans('evaluations.title'), []) !!} /
        {{ $evaluation->notice->number }} /
        {{ $evaluation->type->name }}
    </h4>
</div>
<div class="heading-elements">
    <a href="{{ route('admin.evaluations.index') }}"
       class="btn btn-link btn-float text-size-small has-text legitRipple">
        <i class=" icon-undo2"></i> <span>{{ trans('actions.back') }}</span>
    </a>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-8">
                <div class="text-thin"><strong>{{ $evaluation->notice->organization->name }}</strong> {{ $evaluation->notice->number }}</div>
                <h4 class="text-thin">{{ $evaluation->notice->name }}</h4>
            </div>
            <div class="box">
                <div class="col-sm-2 text-center text-muted">
                    <div class="text-size-mini">{{ trans('evaluations.attributes.notice_type') }}</div>
                    <div>{{ $evaluation->notice ? $evaluation->notice->type->name : blank_icon(nil) }}</div>
                </div>
                <div class="col-sm-2 text-center text-muted">
                    <div class="text-size-mini">{{ trans('evaluations.attributes.type') }}</div>
                    <div>{{ $evaluation->type ? $evaluation->type->name : blank_icon(nil) }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<ul class="nav nav-tabs nav-justified nav-tabs-component bg-blue-700">
    <li class="active"><a href="#tab-evaluation" data-toggle="tab" class="legitRipple">{{ trans('evaluations.views.edit.evaluation') }}</a></li>
    <li><a href="#tab-submission" data-toggle="tab" class="legitRipple">{{ trans('evaluations.views.edit.submission') }}</a></li>
</ul>

<div class="tab-content">
    @include('admin.evaluations.form')
</div>

@endsection