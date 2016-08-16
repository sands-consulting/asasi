@extends('layouts.admin')

@section('header')
<div class="page-title">
    <h4>
        {{ link_to_route('admin.notices.index', trans('notices.title')) }} /
        <span class="text-semibold">{{ trans('notices.views.show.title') }}</span>
    </h4>
</div>
<div class="heading-elements">
    <div class="heading-btn-group">
        @if($notice->canPublish() && Auth::user()->hasPermission('notice:publish'))
        <a href="{{ route('admin.notices.publish', $notice->id) }}" data-method="PUT" class="btn btn-link btn-float text-size-small has-text text-blue legitRipple">
            <i class="icon-check"></i> <span>{{ trans('actions.publish') }}</span>
        </a>
        @endif

        @if($notice->canUnpublish() && Auth::user()->hasPermission('notice:unpublish'))
        <a href="{{ route('admin.notices.unpublish', $notice->id) }}" data-method="PUT" class="btn btn-link btn-float text-size-small has-text text-warning legitRipple">
            <i class="icon-minus-circle2"></i> <span>{{ trans('actions.unpublish') }}</span>
        </a>
        @endif

        @if(Auth::user()->hasPermission('notice:update'))
        <a href="{{ route('admin.notices.edit', $notice->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class="icon-pencil5"></i> <span>{{ trans('notices.buttons.edit') }}</span>
        </a>
        @endif
    </div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">{{ trans('notices.views.show.title') }}: {{ $notice->name }}</h5>
    </div>
    
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
    </div>
</div>
@endsection
