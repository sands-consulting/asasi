@extends('layouts.admin')

@section('page-title', trans('evaluations.vendors'))

@section('header')
<div class="page-title">
    <h4>{{ trans('evaluations.title') }}</h4>
</div>
<div class="heading-elements">
    <a href="{{ route('admin.evaluations.index') }}"
       class="btn btn-link btn-float text-size-small has-text legitRipple">
        <i class=" icon-undo2"></i> <span>{{ trans('actions.back') }}</span>
    </a>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-flat">
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="text-muted">{{ $evaluation->notice->number }}</div>
                        <a href="{{ route('admin.evaluations.show', $evaluation->id) }}">{{ $evaluation->notice->name }}</a>
                    </div>
                    <div class="box">
                        <div class="col-sm-2 text-center text-muted">
                            <div class="text-size-mini">Notice Type</div>
                            <div>{{ $evaluation->notice ? $evaluation->notice->type->name : 'N/A' }}</div>
                        </div>
                        <div class="col-sm-2 text-center text-muted">
                            <div class="text-size-mini">Evaluation Type</div>
                            <div>{{ $evaluation->type ? $evaluation->type->name : 'N/A' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">Evaluations</h6>
            </div>
            {!! Former::open(route('admin.evaluations.update', [$evaluation->id, $submission->id]))->method('PUT') !!}
            <div class="panel-body">
                @include('admin.evaluations.form')
            </div>
            <div class="panel-footer">
                <div class="text-right">
                    <button type="submit" class="btn btn-primary bg-blue-400 pl-20 pr-20">{{ trans('actions.save') }}</button>
                </div>
            </div>
            {!! Former::close() !!}
        </div>
    </div>
</div>
@endsection
