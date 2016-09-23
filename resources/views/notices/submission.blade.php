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
            <fieldset>
                <legend class="text-semibold">
                    <i class="icon-file-text2 position-left"></i>
                    Notice Details
                </legend>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label"><strong>{{ trans('notices.attributes.name') }}</strong>:</label>
                            <div class="form-control-static">{{ $notice->name }}</div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label"><strong>{{ trans('notices.attributes.number') }}</strong>:</label>
                            <div class="form-control-static">{{ $notice->number }}</div>
                        </div>
                    </div>
                    <div class="col-sm-4">
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
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="control-label"><strong>{{ trans('notices.attributes.rules') }}</strong>:</label>
                            <div class="form-control-static">{!! !empty($notice->rules) ? nl2br($notice->rules) : 'N/A' !!}</div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="control-label"><strong>{{ trans('notices.attributes.published_at') }}</strong>:</label>
                            <div class="form-control-static">{{ $notice->published_at ? $notice->published_at->getFromSetting() : 'N/A' }}</div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="control-label"><strong>{{ trans('notices.attributes.expired_at') }}</strong>:</label>
                            <div class="form-control-static">{{ $notice->expired_at ? $notice->expired_at->getFromSetting() : 'N/A' }}</div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="control-label"><strong>{{ trans('notices.attributes.purchased_at') }}</strong>:</label>
                            <div class="form-control-static">{{ $notice->purchased_at ? $notice->purchased_at->getFromSetting() : 'N/A' }}</div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="control-label"><strong>{{ trans('notices.attributes.price') }}</strong>:</label>
                            <div class="form-control-static">{{ $notice->price ? $notice->price : 'N/A' }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label"><strong>{{ trans('notices.attributes.submission_at') }}</strong>:</label>
                            <div class="form-control-static">{{ $notice->submission_at ? $notice->submission_at->getFromSetting() : 'N/A' }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label"><strong>{{ trans('notices.attributes.submission_address') }}</strong>:</label>
                            <div class="form-control-static">{!! $notice->submission_address ? nl2br($notice->submission_address) : 'N/A' !!}</div>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend class="text-semibold">
                    <i class="icon-file-text2 position-left"></i>
                    Notice Requirements
                </legend>
                
                @if ($notice->requirementCommercials)
                <div class="row">
                    <div class="col-sm-6">
                        <i class="icon-coins"></i> Commercials
                    </div>
                    <div class="col-sm-2">
                        @if ($submissions['commercial']->status == 'draft')
                        <span class="label label-danger">
                        @else
                        <span class="label label-success">
                        @endif
                        {{ $submissions['commercial']->status }}</span>
                    </div>
                    <div class="col-sm-4 text-right">
                        @if (!$submissions['commercial'])
                        <a href="{{ route('notices.commercial', $notice->id) }}" class="btn btn-xs btn-default" data-method="POST">Show</a>  
                        @else
                        <a href="{{ route('notices.commercial-edit', [$notice->id, $submissions['commercial']->id] ) }}" class="btn btn-xs btn-default" data-method="POST">Show</a>  
                        @endif
                    </div>                    
                </div>
                <br>
                @endif
                @if ($notice->requirementTechnicals)
                <div class="row">
                    <div class="col-sm-6">
                        <i class="icon-wrench2"></i> Technicals
                    </div>
                    <div class="col-sm-2">
                        @if ($submissions['technical']->status == 'draft')
                        <span class="label label-danger">
                        @else
                        <span class="label label-success">
                        @endif
                        {{ $submissions['technical']->status }}</span>
                    </div>
                    <div class="col-sm-4 text-right">
                        @if (!$submissions['technical'])
                        <a href="{{ route('notices.technical', $notice->id) }}" class="btn btn-xs btn-default" data-method="POST">Show</a>
                        @else
                        <a href="{{ route('notices.technical-edit', [$notice->id, $submissions['technical']->id]) }}" class="btn btn-xs btn-default" data-method="POST">Show</a>
                        @endif
                    </div>                    
                </div>
                @endif
            </fieldset>
            <hr>
            <div class="text-right">
                @if($submissions['commercial']->canSubmit() && $submissions['technical']->canSubmit())
                    <button type="submit" class="btn btn-primary legitRipple">Submit <i class="icon-arrow-right14 position-right"></i></button>
                @else
                    <button type="button" class="btn btn-primary legitRipple" data-placement="left" data-popup="tooltip" title="{{ trans('app.incomplete_tooltip') }}">Submit <i class="icon-arrow-right14 position-right" ></i></button>
                @endif
            </div>
        </div>
    </div>
@stop