@extends('layouts.admin')

@section('header')
<div class="page-title">
    <h4>
        {{ link_to_route('notifications.index', trans('notifications.title')) }} /
        <span class="text-semibold">{{ trans('notifications.views.create.title') }}</span>
    </h4>
</div>
<div class="heading-elements">
    <div class="heading-btn-group">
        <a href="{{ route('notifications.index') }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class=" icon-undo2"></i> <span>{{ trans('notifications.buttons.all') }}</span>
        </a>
    </div>
</div>
@endsection

@section('secondary-header')
<ul class="breadcrumb breadcrumb-caret">
    <li><a href="{{ route('admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
    <li class="active">{{ trans('notifications.views.index.title') }}</li>
</ul>
@endsection

@section('secondary-sidebar')
<!-- Secondary sidebar -->
<div class="sidebar sidebar-secondary sidebar-default">
    <div class="sidebar-content">

        <!-- Search messages -->
        <div class="sidebar-category">
            <div class="category-title">
                <span>Search messages</span>
                <ul class="icons-list">
                    <li><a href="#" data-action="collapse"></a></li>
                </ul>
            </div>

            <div class="category-content">
                <form action="#">
                    <div class="has-feedback has-feedback-left">
                        <input type="search" class="form-control" placeholder="Type and hit Enter">
                        <div class="form-control-feedback">
                            <i class="icon-search4 text-size-base text-muted"></i>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /search messages -->

        <!-- Sub navigation -->
        <div class="sidebar-category">
            <div class="category-title">
                <span>Navigation</span>
                <ul class="icons-list">
                    <li><a href="#" data-action="collapse"></a></li>
                </ul>
            </div>

            <div class="category-content no-padding">
                <ul class="navigation navigation-alt navigation-accordion">
                    <li><a href="#"><i class="icon-files-empty"></i> All messages <span class="badge badge-danger">99+</span></a></li>
                    <li><a href="#"><i class="icon-file-plus"></i> Active discussions <span class="badge badge-default">32</span></a></li>
                    <li><a href="#"><i class="icon-file-locked"></i> Closed discussions</a></li>
                </ul>
            </div>
        </div>
        <!-- /sub navigation -->

    </div>
</div>
<!-- /secondary sidebar -->
@endsection

@section('content')
    <div class="col-sm-12">
        <div class="panel panel-flat">
            <div class="panel-heading">
                Notifications
            </div>
            <div class="table-responsive">
                <table class="table text-nowrap">
                    <tbody>
                        @forelse ($notifications as $notification)
                        <tr>
                            <td width="3px">
                                @if ($notification->unread)
                                    <span class="status-mark border-blue position-left"></span></td>
                                @endif
                            <td> 
                                <div class="">
                                    <a href="{{ route('notifications.show', $notification->id) }}" class="text-default text-semibold">
                                        {{ $notification->content }}
                                    </a>
                                </div>
                            </td>
                            <td class="text-right"><span class="text-muted text-size-small">{{ $notification->created_at->diffForHumans() }}</span></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3">Tou have no notification</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection