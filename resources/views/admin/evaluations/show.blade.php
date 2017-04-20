@extends('layouts.admin')

@section('page-title', implode(' | ', [
    $evaluation->type->name,
    $evaluation->notice->number,
    trans('evaluations.title')
]))

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
@include('admin.evaluations.header')

<ul class="nav nav-tabs nav-justified nav-tabs-component bg-blue-700">
    <li class="active"><a href="#tab-evaluation" data-toggle="tab" class="legitRipple">{{ trans('evaluations.views.show.evaluation') }}</a></li>
    <li><a href="#tab-submission" data-toggle="tab" class="legitRipple">{{ trans('evaluations.views.show.submission') }}</a></li>
</ul>

<div class="tab-content">
    @include('admin.evaluations.form')
    @include('admin.evaluations.submission')
</div>
@endsection