@extends('layouts.admin')

@section('header')
<div class="page-title">
    <h4>
        {{ link_to_route('admin.news.index', trans('news.title')) }} /
        <span class="text-semibold">{{ trans('news.views.create.title') }}</span>
    </h4>
</div>
<div class="heading-elements">
    <div class="heading-btn-group">
        <a href="{{ route('admin.news.index') }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class=" icon-undo2"></i> <span>{{ trans('news.buttons.all') }}</span>
        </a>
    </div>
</div>
@endsection

@section('secondary-header')
<ul class="breadcrumb breadcrumb-caret">
    <li><a href="{{ route('admin') }}"><i class="icon-home2 position-left"></i> Home</a></li>
    <li><a href="{{ route('admin.news.create') }}">{{ trans('news.title') }}</a></li>
    <li class="active">{{ trans('news.views.create.title') }}</li>
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
                    <li class="navigation-header">Actions</li>
                    <li><a href="#"><i class="icon-compose"></i> Compose message</a></li>
                    <li><a href="#"><i class="icon-collaboration"></i> Conference</a></li>
                    <li><a href="#"><i class="icon-user-plus"></i> Add users <span class="label label-success">32 online</span></a></li>
                    <li><a href="#"><i class="icon-users"></i> Create team</a></li>
                    <li class="navigation-divider"></li>
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
            {{ $notification->content }}
        </div>

        <div class="panel-body">
            {{ $notification->content }}
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection