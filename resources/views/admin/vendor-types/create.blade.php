@extends('layouts.admin')

@section('page-title', implode(' | ', [
	trans('vendor-types.views.create.title'),
	trans('vendor-types.title')
]))

@section('header')
    <div class="page-title">
        <h4>
            {{ link_to_route('admin.vendor-types.index', trans('vendor-types.title')) }} /
            <span class="text-semibold">{{ trans('vendor-types.views.create.title') }}</span>
        </h4>
    </div>
    <div class="heading-elements">
        <div class="heading-btn-group">
            <a href="{{ route('admin.vendor-types.index') }}"
               class="btn btn-link btn-float text-size-small has-text legitRipple">
                <i class=" icon-undo2"></i> <span>{{ trans('vendor-types.buttons.all') }}</span>
            </a>
        </div>
    </div>
@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-body">
            {!! Former::open(route('admin.vendor-types.store'))->method('POST') !!}
            {!! Former::populate($type) !!}
            @include('admin.vendor-types.form')
            {!! Former::close() !!}
        </div>
    </div>
@endsection