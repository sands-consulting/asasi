@extends('layouts.admin')

@section('header')
<div class="page-title">
    <h4>
        <span>{{ trans('evaluators.title') }}</span> /
        <span class="text-semibold">{{ trans('notices.views.settings.title') }}</span>
    </h4>
</div>
<div class="heading-elements">
    <div class="heading-btn-group">
        <a href="{{ route('admin.evaluators.edit', $evaluator->notice->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class=" icon-pencil"></i> <span>{{ trans('actions.edit') }}</span>
        </a>
        <a href="{{ route('admin.notices.show', $evaluator->notice->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class=" icon-undo2"></i> <span>{{ trans('actions.back') }}</span>
        </a>
    </div>
</div>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-8">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">{{ trans('evaluators.views.request.panels.notice') }}</h5>
                </div>
                <div class="panel-body">
                    <div class="row mb-15">
                        <div class="col-sm-8">
                            <div class="text-muted">Name</div>
                            <div>{{ $evaluator->notice->name }}</div>
                        </div>
                        <div class="col-sm-4">
                            <div class="text-muted">Number</div>
                            <div>{{ $evaluator->notice->number }}</div>
                        </div>
                    </div>
                    <div class="row mb-20">
                        <div class="col-sm-4">
                            <div class="text-muted">Price</div>
                            <div>{{ $evaluator->notice->price }}</div>
                        </div>
                        <div class="col-sm-4">
                            <div class="text-muted">Type</div>
                            <div>{{ $evaluator->notice->type->name }}</div>
                        </div>
                        <div class="col-sm-4">
                            <div class="text-muted">Expired At</div>
                            <div>{{ $evaluator->notice->expired_at->formatDateFromSetting() }}</div>
                        </div>
                    </div>
                    <div class="row mb-15">
                        <div class="col-sm-4">
                            <div class="text-muted">Published At</div>
                            <div>{{ $evaluator->notice->published_at->formatDateFromSetting() }}</div>
                        </div>
                        <div class="col-sm-4">
                            <div class="text-muted">Expired At</div>
                            <div>{{ $evaluator->notice->expired_at->formatDateFromSetting() }}</div>
                        </div>
                        <div class="col-sm-4">
                            <div class="text-muted">Purchased At</div>
                            <div>{{ $evaluator->notice->purchased_at->formatDateFromSetting() }}</div>
                        </div>
                    </div>
                    <div class="row mb-20">
                        <div class="col-sm-12">
                            <div class="text-muted">Description</div>
                            <div>{{ $evaluator->notice->description }}</div>
                        </div>
                    </div>
                    <div class="row mb-20">
                        <div class="col-sm-12">
                            <div class="text-muted">Type</div>
                            <div>{{ $evaluator->notice->rules }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">{{ trans('evaluators.views.request.panels.action') }}</h5>
                </div>
                <div class="panel-body">
                    <div class="row mb-20">
                        <div class="col-sm-12">
                            <div class="text-muted">Name</div>
                            <div>{{ $evaluator->user->name }}</div>
                        </div>
                    </div>
                    <div class="row mb-20">
                        <div class="col-sm-12">
                            <div class="text-muted">Evaluation Type</div>
                            <div>{{ $evaluator->type->name }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="{{ route('admin.evaluators.accept', $evaluator->id) }}" class="btn btn-primary btn-block btn-xs" data-method="PUT">{{ trans('evaluators.buttons.accept') }}</a>
                        </div>
                        <div class="col-sm-6">
                            <a href="{{ route('admin.evaluators.decline', $evaluator->id) }}" class="btn btn-danger btn-block btn-xs" data-method="PUT">{{ trans('evaluators.buttons.decline') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
