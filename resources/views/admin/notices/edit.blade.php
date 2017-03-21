@extends('layouts.admin')

@section('page-title', implode(' | ', [trans('revisions.title'), $notice->number, trans('notices.title')]))

@section('header')
<div class="page-title">
    <h4>{{ trans('notices.views.admin.edit.title') }}</h4>
</div>
<div class="heading-elements">
    <div class="heading-btn-group">
        <a href="{{ route('admin.notices.show', $notice->id )}}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class=" icon-undo2"></i> <span>{{ trans('actions.back') }}</span>
        </a>
    </div>
</div>
@endsection

@section('secondary-header')
<ul class="breadcrumb breadcrumb-caret">
    <li><a href="{{ route('admin') }}"><i class="icon-home2 position-left"></i> {{ trans('app.admin') }}</a></li>
    <li><a href="{{ route('admin.notices.index') }}">{{ trans('notices.title') }}</a></li>
    <li><a href="{{ route('admin.notices.show', $notice->id )}}">{{ $notice->number }}</a></li>
</ul>
@endsection

@section('content')
{!! Former::vertical_open(route('admin.notices.show', $notice->id)) !!}
	@include('admin.notices.form')
{!! Former::close() !!}
@endsection
