@extends('layouts.public')

@section('header')
    <div class="page-title">
        <h4><i class="icon-file-text position-left"></i> <span class="text-semibold">{{ trans('notices.views.submission.title') }}</span></h4>

        {{-- <ul class="breadcrumb breadcrumb-caret position-right">
            <li><a href="{{ route('home.index') }}">Home</a></li>
            <li class="active">{{ trans('subscriptions.views.history.title') }}</li>
        </ul> --}}
    </div>
    
    @if(Auth::user() && Auth::user()->hasPermission('access:vendor'))
    <div class="heading-elements">
        <div class="heading-btn-group">
            <a href="{{ route('subscriptions.current') }}" class="btn btn-link btn-float has-text text-size-small legitRipple"><i class="icon-stack text-indigo-400"></i> <span>My Package</span></a>
            <a href="{{ route('notices.my-notices') }}" class="btn btn-link btn-float has-text text-size-small legitRipple"><i class="icon-clipboard3 text-indigo-400"></i> <span>My Notices</span></a>
        </div>
    </div>
    @endif
@stop
@section('content')
    <div class="panel panel-flat">        
        <div class="panel-body">
            <div class="row row-eq-height">
                <div class="col-sm-9 eq-element" style="border-right: 0.5px solid #dcdcdc">
                    <div class="row">
                        <div class="col-md-12">
                            <h5>Notice Details</h5>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-sm-8">
                            <div class="text-muted">{{ trans('notices.attributes.name') }}</div>
                            <div class="form-control-static">{{ $notice->name }}</div>
                        </div>
                        <div class="col-sm-4">
                            <div class="text-muted">{{ trans('notices.attributes.number') }}</div>
                            <div class="form-control-static">{{ $notice->number }}</div>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-sm-4">
                            <div class="text-muted">{{ trans('notices.attributes.price') }}</div>
                            <div class="form-control-static">{{ $notice->price ? $notice->price : 'N/A' }}</div>
                        </div>
                        <div class="col-sm-4">
                            <div class="text-muted">{{ trans('notices.attributes.notice_type_id') }}</div>
                            <div class="form-control-static">{{ $notice->type ? $notice->type->name : 'N/A' }}</div>
                        </div>
                        <div class="col-sm-4">
                            <div class="text-muted">{{ trans('notices.attributes.expired_at') }}</div>
                            <div class="form-control-static">{{ $notice->expired_at ? $notice->expired_at->formatDateFromSetting() : 'N/A' }}</div>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-sm-4">
                            <div class="text-muted">{{ trans('notices.attributes.published_at') }}</div>
                            <div class="form-control-static">{{ $notice->published_at ? $notice->published_at->formatDateFromSetting() : 'N/A' }}</div>
                        </div>
                        <div class="col-sm-4">
                            <div class="text-muted">{{ trans('notices.attributes.purchased_at') }}</div>
                            <div class="form-control-static">{{ $notice->purchased_at ? $notice->purchased_at->formatDateFromSetting() : 'N/A' }}</div>
                        </div>
                        <div class="col-sm-4">
                            <div class="text-muted">{{ trans('notices.attributes.submission_at') }}</div>
                            <div class="form-control-static">{{ $notice->submission_at ? $notice->submission_at->formatDateFromSetting() : 'N/A' }}</div>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-sm-6">
                            <div class="text-muted">{{ trans('notices.attributes.submission_address') }}</div>
                            <div class="form-control-static">{!! $notice->submission_address ? nl2br($notice->submission_address) : 'N/A' !!}</div>
                        </div>    
                    </div>

                    <div class="row mb-5">
                        <div class="col-sm-12">
                            <div class="text-muted">{{ trans('notices.attributes.description') }}</div>
                            <div class="form-control-static">{{ !empty($notice->description) ? nl2br($notice->description) : 'N/A' }}</div>
                        </div>
                        <div class="col-sm-12">
                            <div class="text-muted">{{ trans('notices.attributes.rules') }}</div>
                            <div class="form-control-static">{!! !empty($notice->rules) ? nl2br($notice->rules) : 'N/A' !!}</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 eq-element">
                    <div class="row">
                        <div class="col-md-12">
                            <h5>Notice Requirements</h5>
                        </div>
                    </div>
                    {{-- Commercial --}}
                    @if ($notice->requirementCommercials)
                        <div class="row mb-20">
                            {{-- <div class="col-sm-12 mb-5">
                                @if (App\Repositories\SubmissionsRepository::checkComplete($notice, $submission, 1))
                                    <span class="label label-success">Completed</span>
                                @else
                                    <span class="label label-danger">Incomplete</span>
                                @endif
                            </div> --}}
                            <div class="col-sm-12 mb-5">
                                Commercials
                                @if (App\Repositories\SubmissionsRepository::checkComplete($notice, $submission, 1))
                                    <span class="label label-success label-rounded pull-right"><span class="text-thin">Completed</span></span>
                                @else
                                    <span class="label label-danger label-rounded pull-right"><span class="text-thin">Incomplete</span></span>
                                @endif
                            </div>
                            <div class="col-sm-12">
                                <p class="text-muted"><small class="text-italic">Note: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic, corporis minus vel! Quibusdam dolor, cupiditate harum autem commodi.</small></p>
                                @if (!$submission->submitted())
                                <div class="text-right">
                                    @if ($submission->details(1)->get()->isEmpty())
                                    <a href="{{ route('notices.commercial', $notice->id) }}" data-method="POST">
                                        <small>
                                            {{ trans('submissions.buttons.public.commercial.view') }}
                                            <i class="icon-arrow-right22"></i>
                                        </small>
                                    </a>  
                                    @else
                                    <a href="{{ route('notices.commercial-edit', [$notice->id, $submission->id] ) }}" data-method="POST">
                                        <small>
                                            {{ trans('submissions.buttons.public.commercial.view') }}
                                            <i class="icon-arrow-right22"></i>
                                        </small>
                                    </a>
                                    @endif
                                </div>
                                @endif
                            </div>                    
                        </div>
                        <hr>    
                    @endif
                    {{-- Technical --}}
                    @if ($notice->requirementTechnicals)
                        <div class="row">
                            <div class="col-sm-12 mb-5">
                                Technicals
                                @if (App\Repositories\SubmissionsRepository::checkComplete($notice, $submission, 2))
                                    <span class="label label-success label-rounded pull-right"><span class="text-thin">Completed</span></span>
                                @else
                                    <span class="label label-danger label-rounded pull-right"><span class="text-thin">Incomplete</span></span>
                                @endif
                            </div>
                            <div class="col-sm-12">
                                <p class="text-muted"><small class="text-italic">Note: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic, corporis minus vel! Quibusdam dolor, cupiditate harum autem commodi.</small></p>
                                @if (!$submission->submitted())
                                <div class="text-right">
                                    @if ($submission->details(2)->get()->isEmpty())
                                    <a href="{{ route('notices.technical', $notice->id) }}" data-method="POST">
                                        <small>
                                            {{ trans('submissions.buttons.public.technical.view') }}
                                            <i class="icon-arrow-right22"></i>
                                        </small>
                                    </a>
                                    @else
                                    <a href="{{ route('notices.technical-edit', [$notice->id, $submission->id]) }}"data-method="POST">
                                        <small>
                                            {{ trans('submissions.buttons.public.technical.view') }}
                                            <i class="icon-arrow-right22"></i>
                                        </small>
                                    </a>
                                    @endif
                                </div>
                                @endif
                            </div>                    
                        </div>
                    @endif
                    @if($submission->submitted())
                        <a 
                            href="{{ route('notices.submission-slip', $submission->id) }}"
                            class="btn btn-default btn-block legitRipple submission-btn" 
                            <span class="text-thin">Print Slip</span>
                        </a>
                    @elseif(App\Repositories\SubmissionsRepository::checkComplete($notice, $submission))
                        <a 
                            href="{{ route('notices.submission-submit', $submission->id) }}"
                            data-method="POST"
                            class="btn btn-primary btn-block legitRipple submission-btn" 
                            <span class="text-thin">Submit</span>
                        </a>
                    @else
                        <p class="submission-btn text-danger">Please complete requirement above and submit before proceed.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop