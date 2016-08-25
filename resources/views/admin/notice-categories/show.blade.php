@extends('layouts.admin')

@section('header')
<div class="page-title">
    <h4>
        {{ link_to_route('admin.notice-categories.index', trans('notice-categories.title')) }} /
        <span class="text-semibold">{{ trans('notice-categories.views.show.title') }}</span>
    </h4>
</div>
<div class="heading-elements">
    <div class="heading-btn-group">
        @if($noticeCategory->canActivate() && Auth::user()->hasPermission('notice-type:activate'))
        <a href="{{ route('admin.notice-categories.activate', $noticeCategory->id) }}" data-method="PUT" class="btn btn-link btn-float text-size-small has-text text-blue legitRipple">
            <i class="icon-check"></i> <span>{{ trans('actions.activate') }}</span>
        </a>
        @endif

        @if($noticeCategory->canDeactivate() && Auth::user()->hasPermission('notice-type:deactivate'))
        <a href="{{ route('admin.notice-categories.deactivate', $noticeCategory->id) }}" data-method="PUT" class="btn btn-link btn-float text-size-small has-text text-warning legitRipple">
            <i class="icon-minus-circle2"></i> <span>{{ trans('actions.deactivate') }}</span>
        </a>
        @endif

        @if(Auth::user()->hasPermission('notice-type:update'))
        <a href="{{ route('admin.notice-categories.edit', $noticeCategory->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class="icon-pencil5"></i> <span>{{ trans('notice-categories.buttons.edit') }}</span>
        </a>
        @endif
    </div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">{{ trans('notice-categories.views.show.title') }}: {{ $noticeCategory->name }}</h5>
    </div>
    
    <div class="panel-body">
        <fieldset>
            <legend class="text-semibold">
                <i class="icon-file-text2 position-left"></i>
                {{ trans('notice-categories.views.show.details') }}
            </legend>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label"><strong>{{ trans('notice-categories.attributes.name') }}</strong>:</label>
                        <div class="form-control-static">{{ $noticeCategory->name }}</div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label"><strong>{{ trans('notice-categories.attributes.status') }}</strong>:</label>
                        <div class="form-control-static">
                            @if($noticeCategory->status == 'active')
                            <span class="label label-success">
                            @elseif($noticeCategory->status == 'inactive')
                            <span class="label label-danger">
                            @else
                            <span class="label label-default">
                            @endif
                            {{ trans('statuses.' . $noticeCategory->status) }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label"><strong>{{ trans('notice-categories.attributes.created_at') }}</strong>:</label>
                        <div class="form-control-static">{{ $noticeCategory->created_at }}</div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label"><strong>{{ trans('notice-categories.attributes.updated_at') }}</strong>:</label>
                        <div class="form-control-static">{{ $noticeCategory->updated_at }}</div>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
</div>
@endsection
