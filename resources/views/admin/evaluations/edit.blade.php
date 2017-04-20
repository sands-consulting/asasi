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
<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">{{ $evaluation->notice->name }}</h4>
    </div>

    <table class="table table-bordered table-condensed">
        <tr>
            <th class="col-xs-2">{{ trans('evaluations.attributes.notice_number') }}</th>
            <td class="col-xs-2">{{ $evaluation->notice->number }}</td>
            <th class="col-xs-2">{{ trans('evaluations.attributes.notice_type') }}</th>
            <td class="col-xs-2">{{ $evaluation->notice ? $evaluation->notice->type->name : blank_icon(nil) }}</td>
            <th class="col-xs-2">{{ trans('evaluations.attributes.organization') }}</th>
            <td class="col-xs-2">{{ $evaluation->notice->organization->name }}</td>
        </tr>
        <tr>
            <th class="col-xs-2">{{ trans('evaluations.attributes.submission') }}</th>
            <td class="col-xs-2">{{ $evaluation->submission->number }}</td>
            <th class="col-xs-2">{{ trans('evaluations.attributes.submitted_at') }}</th>
            <td class="col-xs-2">{{ $evaluation->submission->submitted_at->format('d/m/Y H:i:s') }}</td>
            <th class="col-xs-2">{{ trans('evaluations.attributes.type') }}</th>
            <td class="col-xs-2">{{ $evaluation->type ? $evaluation->type->name : blank_icon(nil) }}</td>
        </tr>
    </table>
</div>

<ul class="nav nav-tabs nav-justified nav-tabs-component bg-blue-700">
    <li class="active"><a href="#tab-evaluation" data-toggle="tab" class="legitRipple">{{ trans('evaluations.views.edit.evaluation') }}</a></li>
    <li><a href="#tab-submission" data-toggle="tab" class="legitRipple">{{ trans('evaluations.views.edit.submission') }}</a></li>
</ul>

<div class="tab-content">
    @include('admin.evaluations.form')
</div>

@endsection