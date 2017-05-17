@extends('layouts.app')

@section('page-title', implode(' | ', [
	trans('tax-codes.views.create.title'),
	trans('tax-codes.title')
]))

@section('header')
    <div class="page-title">
        <h4>
            {{ link_to_route('admin.tax-codes.index', trans('tax-codes.title')) }} /
            <span class="text-semibold">{{ trans('tax-codes.views.create.title') }}</span>
        </h4>
    </div>
    <div class="heading-elements">
        <div class="heading-btn-group">
            <a href="{{ route('admin.tax-codes.index') }}"
               class="btn btn-link btn-float text-size-small has-text legitRipple">
                <i class=" icon-undo2"></i> <span>{{ trans('tax-codes.buttons.all') }}</span>
            </a>
        </div>
    </div>
@endsection

@section('secondary-header')
    <ul class="breadcrumb breadcrumb-caret">
        <li><a href="{{ route('admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="{{ route('admin.tax-codes.create') }}">{{ trans('tax-codes.views.index.breadcrumb') }}</a></li>
        <li class="active">{{ trans('tax-codes.views.create.breadcrumb') }}</li>
    </ul>
@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-body">
            {!! Former::open(action('Admin\TaxCodesController@store'))->method('POST') !!}
            @include('admin.tax-codes.form')
            {!! Former::close() !!}
        </div>
    </div>
@endsection