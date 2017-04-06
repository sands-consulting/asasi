@extends('layouts.admin')

@section('page-title', implode(' | ', [ trans('actions.edit'), $tax_code->name, trans('tax-codes.title') ]))

@section('header')
    <div class="page-title">
        <h4>
            {{ link_to_route('admin.tax-codes.index', trans('tax-codes.title')) }} /
            <span class="text-semibold">{{ trans('actions.edit') }}</span>
        </h4>
    </div>
    <div class="heading-elements">
        <div class="heading-btn-group">
            <a href="{{ route('admin.tax-codes.index') }}"
               class="btn btn-link btn-float text-size-small has-text legitRipple">
                <i class=" icon-undo2"></i> <span>{{ trans('actions.back') }}</span>
            </a>
        </div>
    </div>
@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-body">
            {!! Former::open(action('Admin\TaxCodesController@update', $tax_code->id))->method('PUT') !!}
            {!! Former::populate($tax_code) !!}
            @include('admin.tax-codes.form')
            {!! Former::close() !!}
        </div>
    </div>
@endsection