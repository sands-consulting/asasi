@extends('layouts.window')

@section('content')
    <div class="panel panel-flat">        
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12 no-padding">
                            <div class="submission-slip">
                                <div class="slip-header">
                                    <h4 class="slip-title">Submission Slip</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-20 mb-50" style="margin-bottom: 50px">
                            <div class="text-muted text-center">
                                {{ $submission->notice->number }} ({{ $submission->notice->organization->name }})
                            </div>
                            <div class="text-center">{{ $submission->notice->name }}</div>
                        </div>
                        <div class="col-md-6 mb-50">
                            <div class="text-muted text-center">{{ trans('notices.attributes.number') }}</div>
                            <div class="text-center">{{ $submission->notice->number }}</div>
                        </div>
                        <div class="col-md-6 mb-50" style="margin-bottom: 50px">
                            <div class="text-muted text-center">{{ trans('submissions.attributes.submitted_at') }}</div>
                            <div class="text-center">{{ $submission->submitted_at }}</div>
                        </div>
                        <div class="col-sm-12 mb-20 hidden-print" style="margin-bottom: 50px">
                            <div class="text-center">
                                <button class="btn btn-primary" onclick="window.print()"><i class="icon-printer4"></i> Print Slip</button>
                            </div>
                        </div>
                    </div>
                   

                    {{-- <div class="row mb-5">
                        <div class="col-sm-12">
                            <div class="text-muted">{{ trans('notices.attributes.description') }}</div>
                            <div class="form-control-static">{{ !empty($submission->notice->description) ? nl2br($submission->notice->description) : 'N/A' }}</div>
                        </div>
                        <div class="col-sm-12">
                            <div class="text-muted">{{ trans('notices.attributes.rules') }}</div>
                            <div class="form-control-static">{!! !empty($submission->notice->rules) ? nl2br($submission->notice->rules) : 'N/A' !!}</div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@stop