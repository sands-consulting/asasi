@extends('layouts.admin')

@section('header')
<div class="page-title">
    <h4>
        {{ link_to_route('admin.notice-types.index', trans('notice-types.title')) }} /
        <span class="text-semibold">{{ trans('notice-types.views.show.title') }}</span>
    </h4>
</div>
<div class="heading-elements">
    <div class="heading-btn-group">
        @if($noticeType->canActivate() && Auth::user()->hasPermission('notice-type:activate'))
        <a href="{{ route('admin.notice-types.activate', $noticeType->id) }}" data-method="PUT" class="btn btn-link btn-float text-size-small has-text text-blue legitRipple">
            <i class="icon-check"></i> <span>{{ trans('actions.activate') }}</span>
        </a>
        @endif

        @if($noticeType->canDeactivate() && Auth::user()->hasPermission('notice-type:deactivate'))
        <a href="{{ route('admin.notice-types.deactivate', $noticeType->id) }}" data-method="PUT" class="btn btn-link btn-float text-size-small has-text text-warning legitRipple">
            <i class="icon-minus-circle2"></i> <span>{{ trans('actions.deactivate') }}</span>
        </a>
        @endif

        @if(Auth::user()->hasPermission('notice-type:update'))
        <a href="{{ route('admin.notice-types.edit', $noticeType->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class="icon-pencil5"></i> <span>{{ trans('notice-types.buttons.edit') }}</span>
        </a>
        @endif
    </div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">{{ trans('notice-types.views.show.title') }}: {{ $noticeType->name }}</h5>
    </div>
    
    <div class="panel-body">
        <fieldset>
            <legend class="text-semibold">
                <i class="icon-file-text2 position-left"></i>
                {{ trans('notice-types.views.show.details') }}
            </legend>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label"><strong>{{ trans('notice-types.attributes.name') }}</strong>:</label>
                        <div class="form-control-static">{{ $noticeType->name }}</div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label"><strong>{{ trans('notice-types.attributes.status') }}</strong>:</label>
                        <div class="form-control-static">
                            @if($noticeType->status == 'active')
                            <span class="label label-success">
                            @elseif($noticeType->status == 'inactive')
                            <span class="label label-danger">
                            @else
                            <span class="label label-default">
                            @endif
                            {{ trans('statuses.' . $noticeType->status) }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label"><strong>{{ trans('notice-types.attributes.created_at') }}</strong>:</label>
                        <div class="form-control-static">{{ $noticeType->created_at }}</div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label"><strong>{{ trans('notice-types.attributes.updated_at') }}</strong>:</label>
                        <div class="form-control-static">{{ $noticeType->updated_at }}</div>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
</div>
@endsection
