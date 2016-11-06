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
        
        @if($notice->canCancel())
        <a href="{{ route('admin.notices.cancel', $notice->id) }}" class="btn btn-link btn-float text-size-small has-text text-danger legitRipple" data-toggle="modal" data-target="#cancel-modal">
            <i class=" icon-cancel-circle2"></i> <span>{{ trans('actions.cancel') }}</span>
        </a>
        @endif
        
        @if(Auth::user()->hasPermission('notice:update'))
        <a href="{{ route('admin.notices.edit', $notice->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class="icon-pencil5"></i> <span>{{ trans('actions.edit') }}</span>
        </a>
        @endif

        @if(Auth::user()->hasPermission('notice:delete'))
        <a href="#" class="btn btn-link btn-float text-size-small has-text text-danger legitRipple" data-toggle="modal" data-target="#delete-modal">
            <i class=" icon-trash"></i> <span>{{ trans('actions.delete') }}</span>
        </a>
        @endif

        <a href="{{ route('admin.notices.index') }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class=" icon-undo2"></i> <span>{{ trans('actions.back') }}</span>
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
    <div class="panel-heading">
        <div class="row">
            <div class="col-sm-10">
                <small class="text-muted">{{ $notice->number}} (<i>{{ $notice->organization->name}}</i>)</small>
                <br>
                {{ $notice->name }}
            </div>
            <div class="heading-elements">
                @if ($notice->status == 'published')
                    <span class="label label-success heading-text">
                @elseif ($notice->status == 'cancelled')
                    <span class="label label-danger heading-text">
                @else
                    <span class="label label-default heading-text">
                @endif
                {{ $notice->status }}</span>
                <ul class="icons-list">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-cog3"></i><span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="#">Notices</a></li>
                            <li><a href="{{ route('admin.evaluation-requirements.edit', $notice->id) }}">{{ trans('evaluation-requirements.title') }}</a></li>
                            <li><a href="{{ route('admin.evaluators.index', $notice->id) }}">Evaluators</a></li>
                            <li class="divider"></li>
                            <li><a href="#">All Settings</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="panel-body">
        <div class="row">
            <div class="tabbable nav-tabs-vertical nav-tabs-left">
                <ul class="nav nav-tabs nav-tabs-highlight">
                    <li class="active">
                        <a data-target="#left-tab1" data-toggle="tab"><i class="icon-clipboard3 position-left"></i> Notice Details</a>
                    </li>
                    <li>
                        <a data-target="#tab-events" data-toggle="tab"><i class="icon-calendar3 position-left"></i> Events</a>
                    </li>
                    <li>
                        <a data-target="#left-tab2" data-toggle="tab"><i class="icon-office position-left"></i> Vendors</a>
                    </li>
                    <li>
                        <a data-target="#left-tab3" data-toggle="tab"><i class="icon-coins position-left"></i> Price List</a>
                    </li>
                    <li>
                        <a data-target="#left-tab4" data-toggle="tab"><i class="icon-coins position-left"></i> Evaluations</a>
                    </li>
                    <li>
                        <a data-target="#left-tab6" data-toggle="tab"><i class="icon-medal-star position-left"></i> Award</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active has-padding" id="left-tab1">
                        @include('admin.notices.show-notice')
                    </div>
                    
                    <div class="tab-pane has-padding" id="tab-events">
                        @include('admin.notices.show-events')
                    </div>

                    <div class="tab-pane has-padding" id="left-tab2">
                        @include('admin.notices.show-vendors')
                    </div>

                    <div class="tab-pane has-padding" id="left-tab3">
                        @include('admin.notices.show-prices')
                    </div>

                    <div class="tab-pane has-padding" id="left-tab4">
                        @include('admin.notices.show-evaluations-by-evaluator')
                    </div>

                    <div class="tab-pane has-padding" id="left-tab6">
                        @include('admin.notices.show-award')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modals --}}
@include('admin.notices.modals.cancel')
@include('admin.notices.modals.delete')
@endsection
