@extends('layouts.admin')

@section('header')
<div class="page-title">
    <h4>
        {{ trans('evaluators.title') }} /
        <span class="text-semibold">{{ trans('evaluators.views.assign.title') }}</span>
    </h4>
</div>
<div class="heading-elements">
    <div class="heading-btn-group">
        <a href="{{ route('admin.evaluators.index', $notice->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class=" icon-undo2"></i> <span>{{ trans('actions.back') }}</span>
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
    {!! Former::open(route('admin.evaluators.assigned', [$evaluator->id, $notice->id])) !!}
        <div class="panel-heading">
            <div class="row">
                <div class="col-sm-10 panel-title"><span class="text-muted">{{ $notice->number}} (<i>{{ $notice->organization->name}}</i>)</span>
                <br>{{ $notice->name }}</div>
                <div class="col-sm-2 heading-elements">
                    @if ($notice->status == 'published')
                        <span class="label label-success heading-text">
                    @elseif ($notice->status == 'cancelled')
                        <span class="label label-danger heading-text">
                    @else
                        <span class="label label-default heading-text">
                    @endif
                    {{ $notice->status }}</span>
                    <ul class="icons-list">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-cog3"></i><span class="caret"></span></a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="{{ route('admin.notices.show', $notice->id) }}">Notices</a></li>
                                <li><a href="{{ route('admin.evaluation-requirements.edit', $notice->id) }}">{{ trans('evaluation-requirements.title') }}</a></li>
                                <li><a href="{{ route('admin.evaluators.index', $notice->id) }}">Evaluators</a></li>
                                <li class="divider"></li>
                                <li><a href="#">All Settings</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <fieldset>
                <legend class="text-semibold"> <i class="icon-clipboard3"></i> Submission List</legend>
                <div class="row">
                    @foreach ($notice->submissions as $submission)
                        <div class="col-sm-3">
                            {!! Former::checkboxes('submission_id[]')
                                ->checkboxes([ 
                                    "Submission " . $submission->id => [
                                        'name' => 'submission_id[]', 
                                        'value' => $submission->id
                                    ]
                                ])
                                ->label(false) !!}
                        </div>
                    @endforeach
                </div>
            </fieldset>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-sm-12 text-right">
                    <button type="submit" class="btn bg-blue-400">Assign</button>
                </div>
            </div>
        </div>
    {!! Former::close() !!}
</div>
@endsection
