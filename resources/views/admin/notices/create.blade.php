@extends('layouts.admin')

@section('page-title', implode(' | ', [trans('notices.views.admin.create.title'), trans('notices.title')]))

@section('header')
<div class="page-title">
    <h4>
		{{ link_to_route('admin.notices.index', trans('notices.title')) }} /
		<span class="text-semibold">{{ trans('notices.views.admin.create.title') }}</span>
	</h4>
</div>
<div class="heading-elements">
    <div class="heading-btn-group">
        <a href="{{ route('admin.notices.index' )}}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class=" icon-undo2"></i> <span>{{ trans('actions.back') }}</span>
        </a>
    </div>
</div>
@endsection

@section('secondary-header')
<ul class="breadcrumb breadcrumb-caret">
    <li><a href="{{ route('admin') }}"><i class="icon-home2 position-left"></i> {{ trans('app.admin') }}</a></li>
    <li><a href="{{ route('admin.notices.index') }}">{{ trans('notices.title') }}</a></li>
</ul>
@endsection

@section('content')
@include('admin.notices.form')
@endsection
