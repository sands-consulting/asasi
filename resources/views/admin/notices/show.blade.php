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
        

        <div class="tabbable nav-tabs-vertical nav-tabs-left">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="active">
                    <a href="#left-tab1" data-toggle="tab"><i class="icon-menu7 position-left"></i> Notice Details</a>
                </li>
                <li>
                    <a href="#left-tab2" data-toggle="tab"><i class="icon-office position-left"></i> Vendors</a>
                </li>
                <li>
                    <a href="#left-tab3" data-toggle="tab"><i class="icon-coins position-left"></i> Price List</a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user position-left"></i> Evaluators <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#left-tab4" data-toggle="tab">Progress</a></li>
                        <li><a href="#left-tab5" data-toggle="tab">Assigned</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#left-tab6" data-toggle="tab"><i class="icon-pencil position-left"></i> Evaluations</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active has-padding" id="left-tab1">
                    @include('admin.notices.show-notice')
                </div>

                <div class="tab-pane has-padding" id="left-tab2">
                    @include('admin.notices.show-vendors')
                </div>

                <div class="tab-pane has-padding" id="left-tab3">
                    @include('admin.notices.show-prices')
                </div>

                <div class="tab-pane has-padding" id="left-tab4">
                    @include('admin.notices.show-evaluators')
                </div>

                <div class="tab-pane has-padding" id="left-tab5">
                    @include('admin.notices.show-evaluators-assign')
                </div>

                <div class="tab-pane has-padding" id="left-tab6">
                    @include('admin.notices.show-evaluations')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
