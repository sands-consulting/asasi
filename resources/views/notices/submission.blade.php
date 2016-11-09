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
            <div class="row">
                <div class="col-sm-9">
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
                <div class="col-sm-3">
                    <div class="row">
                        <div class="col-md-12">
                            <h5>Notice Requirements</h5>
                        </div>
                    </div>
                    {{-- Commercial --}}
                    @if ($notice->requirementCommercials)
                        <div class="row">
                            <div class="col-sm-12 mb-5">
                                @if ($submissions['commercials']->status == 'incomplete')
                                <span class="label label-warning">
                                @else
                                <span class="label label-success">
                                @endif
                                {{ $submissions['commercials']->status }}</span>
                            </div>
                            <div class="col-sm-12 mb-5">Commercials</div>
                            <div class="col-sm-12">
                                @if (!$submissions['commercials'])
                                <a href="{{ route('notices.commercial', $notice->id) }}" data-method="POST">
                                    <small class="text-muted text-thin">
                                        {{ trans('submissions.buttons.public.commercial.view') }}
                                        <span class="pull-right"><i class="icon-arrow-right22"></i></span>
                                    </small>
                                </a>  
                                @else
                                <a href="{{ route('notices.commercial-edit', [$notice->id, $submissions['commercials']->id] ) }}" data-method="POST">
                                    <small class="text-muted text-thin">
                                        {{ trans('submissions.buttons.public.commercial.view') }}
                                        <span class="pull-right"><i class="icon-arrow-right22"></i></span>
                                    </small>
                                </a>  
                                @endif
                            </div>                    
                        </div>
                        <br>
                    @endif
                    {{-- Technical --}}
                    @if ($notice->requirementTechnicals)
                        <div class="row">
                            <div class="col-sm-12 mb-5">
                                @if ($submissions['technicals'])
                                    @if ($submissions['technicals']->status == 'draft')
                                    <span class="label label-danger">
                                    @else
                                    <span class="label label-success">
                                    @endif
                                    {{ $submissions['technicals']->status }}</span>
                                @else
                                    <span class="label label-danger">Incomplete</span>
                                @endif
                            </div>
                            <div class="col-sm-12 mb-5">Technicals</div>
                            <div class="col-sm-12">
                                @if (!$submissions['technicals'])
                                <a href="{{ route('notices.technical', $notice->id) }}" data-method="POST">
                                    <small class="text-muted text-thin">
                                        {{ trans('submissions.buttons.public.technical.view') }}
                                        <span class="pull-right"><i class="icon-arrow-right22"></i></span>
                                    </small>
                                </a>
                                @else
                                <a href="{{ route('notices.technical-edit', [$notice->id, $submissions['technicals']->id]) }}"  data-method="POST">
                                    <small class="text-muted text-thin">
                                        {{ trans('submissions.buttons.public.technical.view') }}
                                        <span class="pull-right"><i class="icon-arrow-right22"></i></span>
                                    </small>
                                </a>
                                @endif
                            </div>                    
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-9"></div>
                <div class="col-md-3">
                    @if($submissions['commercials'] && $submissions['technicals'])
                        @if($submissions['commercials']->canSubmit() && $submissions['technicals']->canSubmit())
                            <button type="submit" class="btn btn-primary btn-block legitRipple">
                                <span class="text-thin">Submit</span>
                            </button>
                        @else
                            <a href="{{ route('notices.submit-submission', $notice->id) }}" 
                                class="btn btn-primary btn-block legitRipple" 
                                data-placement="left" 
                                data-popup="tooltip" 
                                title="{{ trans('app.incomplete_tooltip') }}">
                                <span class="text-thin">Submit</span>
                            </a>
                        @endif
                    @else
                        <p class="text-danger">Please view requirement above and submit before proceed.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop