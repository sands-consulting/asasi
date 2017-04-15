@extends('layouts.admin')

@section('page-title', implode(' | ', [trans('notices.views.admin.edit.title'), $notice->number, trans('notices.title')]))

@section('header')
<div class="page-title">
    <h4>
        {{ link_to_route('admin.notices.index', trans('notices.title')) }} /
        {{ link_to_route('admin.notices.show', $notice->number, $notice->id) }} /
        <span class="text-semibold">{{ trans('notices.views.admin.edit.title') }}</span>
    </h4>
</div>
<div class="heading-elements">
    <div class="heading-btn-group">
        <a href="{{ route('admin.notices.show', $notice->id )}}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class=" icon-undo2"></i> <span>{{ trans('actions.back') }}</span>
        </a>
    </div>
</div>
@endsection

@section('content')
{!! Former::open_vertical_for_files(route('admin.notices.show', $notice->id))->id('form-notice')->method('PUT')->novalidate() !!}
	@include('admin.notices.form')
{!! Former::close() !!}
@endsection
