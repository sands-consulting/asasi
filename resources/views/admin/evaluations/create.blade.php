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
    <div class="col-sm-12">
        <div class="panel panel-flat">
            <div class="panel-body">
                <div class="row is-table-row">
                    <div class="col-sm-8">
                        <div class="text-muted">{{ $notice->number }}</div>
                        <a href="{{ route('admin.notices.show', $notice->id) }}">{{ $notice->name }}</a>
                    </div>
                    <div class="col-sm-2 box text-center text-muted">
                        <div class="text-size-mini">Notice Type</div>
                        <div>{{ $notice->type ? $notice->type->name : 'N/A' }}</div>
                    </div>
                    <div class="col-sm-2 box text-center text-muted">
                        <div class="text-size-mini">Evaluation Type</div>
                        <div>{{ $notice->type ? $notice->type->name : 'N/A' }}</div>
                    </div>
                </div>
                <div class="row is-table-row">
                    <div class="col-sm-12">
                        <div class="text-muted">{{ !empty($notice->description) ? nl2br($notice->description) : 'N/A' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">Evaluations Criteria</h6>
            </div>
            <div class="panel-body">
                {!! Former::open(route('admin.evaluations.store', $notice->id)) !!}

                    <?php $i = 1; ?>
                    @foreach ($evaluationRequirements as $evaluationRequirement)
                        <div class="row is-table-row">
                            <div class="col-sm-1">
                                <div class="box">{{ $i }}</div>
                            </div>
                            <div class="col-sm-8">
                                <div class="box"> 
                                    {{ $evaluationRequirement->title }}
                                </div>  
                            </div>
                            <div class="col-sm-2 greyed">
                                <div class="box text-center">
                                    {!! Former::number('scores['. $evaluationRequirement->id .']')
                                        ->label(false)
                                        ->append('/ ' . $evaluationRequirement->full_score)
                                        ->addClass('text-center')
                                        ->min(0)
                                        ->max($evaluationRequirement->full_score)
                                        ->required() !!}
                                </div>
                            </div>
                        </div>
                        <?php $i++; ?>
                    @endforeach

                    <div class="row is-table-row">
                        <div class="col-sm-12 text center">
                            <button type="submit" class="btn btn-primary bg-blue-400">{{ trans('actions.save') }} <i class="icon-floppy-disk position-right"></i></button>
                        </div>
                    </div>

                {!! Former::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
