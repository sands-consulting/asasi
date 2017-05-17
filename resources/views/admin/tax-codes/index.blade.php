@extends('layouts.app')

@section('page-title', trans('tax-codes.title'))

@section('header')
    <div class="page-title">
        <h4>{{ trans('tax-codes.title') }}</h4>
    </div>
    <div class="heading-elements">
        <div class="heading-btn-group">
            <a href="{{ route('admin.tax-codes.create') }}"
               class="btn btn-link btn-float text-size-small has-text legitRipple">
                <i class=" icon-user-plus"></i> <span>{{ trans('tax-codes.buttons.create') }}</span>
            </a>
        </div>
    </div>
@endsection

@section('secondary-header')
    <ul class="breadcrumb breadcrumb-caret">
        <li><a href="{{ route('admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
        <li class="active">{{ trans('tax-codes.title') }}</li>
    </ul>
@endsection

@section('content')
    <div class="panel panel-flat">
        {!! $dataTable->table() !!}
    </div>
@endsection

@section('scripts')
    {!! $dataTable->scripts() !!}
@endsection