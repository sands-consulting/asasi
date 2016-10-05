@extends('layouts.admin')

@section('header')
<div class="page-title">
    <h4>
        {{ link_to_route('admin.subscriptions.index', trans('subscriptions.title')) }} /
        <span class="text-semibold">{{ trans('subscriptions.views.show.title') }}</span>
    </h4>
</div>
<div class="heading-elements">
    <div class="heading-btn-group">
        @if($subscription->canActivate() && Auth::user()->hasPermission('subscription:activate'))
        <a href="{{ route('admin.subscriptions.activate', $subscription->id) }}" data-method="PUT" class="btn btn-link btn-float text-size-small has-text text-blue legitRipple">
            <i class="icon-check"></i> <span>{{ trans('actions.activate') }}</span>
        </a>
        @endif

        @if($subscription->canDeactivate() && Auth::user()->hasPermission('subscription:deactivate'))
        <a href="{{ route('admin.subscriptions.deactivate', $subscription->id) }}" data-method="PUT" class="btn btn-link btn-float text-size-small has-text text-warning legitRipple">
            <i class="icon-minus-circle2"></i> <span>{{ trans('actions.deactivate') }}</span>
        </a>
        @endif
        
        @if($subscription->canCancel() && Auth::user()->hasPermission('subscription:cancel'))
         <a href="#" class="btn btn-link btn-float text-size-small has-text text-warning legitRipple" data-toggle="modal" data-target="#cancel-modal">
            <i class="icon-cancel-circle2"></i> <span>{{ trans('actions.cancel') }}</span>
        </a>
        @endif 

        {{-- @if(Auth::user()->hasPermission('subscription:delete'))
        <a href="{{ route('admin.subscriptions.destroy', $subscription->id) }}" data-method="DELETE" class="btn btn-link btn-float text-size-small has-text text-warning legitRipple" data-confirm="{{ trans('app.confirmation') }}">
            <i class="icon-cancel-circle2"></i> <span>{{ trans('actions.delete') }}</span>
        </a>
        @endif --}}

        @if(Auth::user()->hasPermission('subscription:update'))
        <a href="{{ route('admin.subscriptions.edit', $subscription->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class="icon-pencil5"></i> <span>{{ trans('subscriptions.buttons.edit') }}</span>
        </a>
        @endif
    </div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">{{ trans('subscriptions.views.show.title') }}</h5>
        <div class="heading-elements">
            @if ($subscription->status == 'active')
                <span class="label label-success heading-text">
            @elseif ($subscription->status == 'expired')
                <span class="label label-danger heading-text">
            @elseif ($subscription->status == 'cancelled')
                <span class="label bg-grey-800 heading-text">
            @else
                <span class="label label-default heading-text">
            @endif
            {{ $subscription->status }}</span>
        </div>
    </div>
    
    <div class="panel-body">
        <fieldset>
            <legend class="text-semibold">
                <i class="icon-file-text2 position-left"></i>
                {{ trans('packages.views.show.legend') }}
            </legend>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label"><strong>{{ trans('subscriptions.attributes.package_id') }}</strong>:</label>
                        <div class="form-control-static">{{ $subscription->package->name }}</div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label"><strong>{{ trans('subscriptions.attributes.started_at') }}</strong>:</label>
                        <div class="form-control-static">{{ $subscription->started_at }}</div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label"><strong>{{ trans('subscriptions.attributes.expired_at') }}</strong>:</label>
                        <div class="form-control-static">{{ $subscription->expired_at }}</div>
                    </div>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend class="text-semibold">
                <i class="icon-file-text2 position-left"></i>
                {{ trans('vendors.views.show.admin.legend') }}
            </legend>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="control-label"><strong>{{ trans('vendors.attributes.name') }}</strong>:</label>
                        <div class="form-control-static">{{ $vendor->name }}</div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label"><strong>{{ trans('vendors.attributes.contact_person_name') }}</strong>:</label>
                        <div class="form-control-static">{{ $vendor->contact_person_name }}</div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label"><strong>{{ trans('vendors.attributes.contact_person_email') }}</strong>:</label>
                        <div class="form-control-static">{{ $vendor->contact_person_email }}</div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label"><strong>{{ trans('vendors.attributes.contact_person_telephone') }}</strong>:</label>
                        <div class="form-control-static">{{ $vendor->contact_person_telephone }}</div>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
</div>

@include('admin.subscriptions.modals.cancel')
@endsection
