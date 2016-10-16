@extends('layouts.admin')

@section('page-title', trans('evaluations.vendors'))

@section('header')
<div class="page-title">
    <h4>{{ trans('evaluations.title') }}</h4>
</div>
<div class="heading-elements">
    
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-4">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">Notices</h6>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="control-label"><strong>{{ trans('notices.attributes.name') }}</strong>:</label>
                            <div class="form-control-static">{{ $notice->name }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label"><strong>{{ trans('notices.attributes.number') }}</strong>:</label>
                            <div class="form-control-static">{{ $notice->number }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label"><strong>{{ trans('notices.attributes.notice_type_id') }}</strong>:</label>
                            <div class="form-control-static">{{ $notice->type ? $notice->type->name : 'N/A' }}</div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="control-label"><strong>{{ trans('notices.attributes.description') }}</strong>:</label>
                            <div class="form-control-static">{{ !empty($notice->description) ? nl2br($notice->description) : 'N/A' }}</div>
                        </div>
                    </div>
                    {{-- <div class="col-sm-12">
                        <div class="form-group">
                            <label class="control-label"><strong>{{ trans('notices.attributes.rules') }}</strong>:</label>
                            <div class="form-control-static">{!! !empty($notice->rules) ? nl2br($notice->rules) : 'N/A' !!}</div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-8">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">Evaluations</h6>
            </div>
            {!! Former::open(route('admin.evaluations.store', $notice->id)) !!}
            <table class="table table-bordered table-striped table-condensed">
                <thead>
                    <tr>
                        <th width="80px">#</th>
                        <th>Title</th>
                        <th width="250px">Score</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @foreach ($evaluationRequirements as $evaluationRequirement)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $evaluationRequirement->title }}</td>
                            <td>
                                {!! Former::number('scores['. $evaluationRequirement->id .']')
                                    ->label(false)
                                    ->append('/ ' . $evaluationRequirement->full_score)
                                    ->addClass('text-center')
                                    ->min(0)
                                    ->max($evaluationRequirement->full_score)
                                    ->required() !!}</td>
                        </tr>
                        <?php $i++; ?>
                    @endforeach
                </tbody>
            </table>
            <div class="panel-footer">
                <div class="text-right">
                    <button type="submit" class="btn btn-primary bg-blue-400">{{ trans('actions.save') }} <i class="icon-floppy-disk position-right"></i></button>
                </div>
            </div>
            {!! Former::close() !!}
        </div>
    </div>
</div>
@endsection
