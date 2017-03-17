<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-param" content="_token">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="socket-url" content="{{ env('APP_SOCKET_URL') }}">
<title>@hasSection('page-title')@yield('page-title') | @endif{{ trans('app.admin') }} | {{ config('app.name') }}</title>
<link href="{{ elixir('assets/css/admin.css') }}" rel="stylesheet">
</head>
<body class="navbar-top v-cloak">
<div class="navbar navbar-inverse navbar-fixed-top bg-blue-700">
    <div class="navbar-boxed">
        <div class="navbar-header">
            <a class="navbar-brand prompt" href="{{ route('admin') }}">
                {{ config('app.name') }}
            </a>

            <ul class="nav navbar-nav visible-xs-block">
                <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            </ul>
        </div>

        <div class="navbar-collapse collapse" id="navbar-mobile">
            <ul class="nav navbar-nav">
                <li>
                    <a class="sidebar-control sidebar-main-toggle hidden-xs legitRipple">
                        <i class="icon-paragraph-justify3"></i>
                    </a>
                </li>
                <li id="notifications" class="dropdown" data-source="{{ route('api.notifications', ['status' => 'unread']) }}">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-bubble-notification"></i>
                        <span class="visible-xs-inline-block position-right">Notifications</span>
                        <span class="badge bg-warning-400" v-cloak v-if="count > 0">@{{ count }}</span>
                        <span class="status-mark border-orange-400" v-cloak v-if="count == 0"></span>
                    </a>
                    
                    <div class="dropdown-menu dropdown-content">
                        <div class="dropdown-content-heading">
                            Notifications
                            <ul class="icons-list">
                                <li><a href="#"><i class="icon-sync"></i></a></li>
                            </ul>
                        </div>

                        <ul class="media-list dropdown-content-body width-350">
                            <template v-if="notifications.length > 0">
                                <li class="media" v-for="notification in notifications">
                                    <div class="media-left">
                                        <a :href="'@{{ notification.link }}'" class="btn border-success text-success btn-flat btn-rounded btn-icon btn-sm"><i class="icon-checkmark4"></i></a>
                                    </div>

                                    <div class="media-body">
                                        @{{ notification.content }}
                                        <div class="media-annotation">@{{ notification.created_at_human }}</div>
                                    </div>
                                </li>
                            </template>
                            <template v-else>
                                <li class="media">
                                    <div class="media-body">
                                        <div class="text-center">You have no notification.</div>
                                    </div>
                                </li>
                            </template>
                        </ul>

                        <div class="dropdown-content-footer">
                            <a href="{{ route('notifications.index') }}" data-popup="tooltip" title="All Notifications"><i class="icon-menu display-block"></i></a>
                        </div>
                    </div>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if(Auth::guest())
                <li><a href="{{ url('login') }}">{{ trans('menu.user.login') }}</a></li>
                <li><a href="{{ url('register') }}">{{ trans('menu.user.register') }}</a></li>
                @else
                <li>
                    <a href="{{ route('contact') }}">
                        <i class="icon-atom2"></i> {{ trans('menu.access.portal') }}
                    </a>
                </li>

                @if(Auth::user()->hasPermission('access:report'))
                <li>
                    <a href="{{ route('admin') }}">
                        <i class="icon-file-text"></i> {{ trans('menu.access.report') }}
                    </a>
                </li>
                @endif
                
                @include('layouts.menu.user')
                @endif
            </ul>
        </div>
    </div>
</div>

<div class="page-container">
    <div class="page-content">
        <div class="sidebar sidebar-main sidebar-default sidebar-fixed">
            <div class="sidebar-content">
                <div class="sidebar-user-material">
                    <div class="category-content">
                        <div class="sidebar-user-material-content">
                            <img src="{{ Gravatar::src(Auth::user()->email)}}" class="img-circle" alt="{{ Auth::user()->name }}">
                        </div>
                                                    
                        <div class="sidebar-user-material-menu">
                            <a href="#">{{ Auth::user()->name }}</a>
                        </div>
                    </div>
                </div>

                <div class="sidebar-category sidebar-category-visible">
                    <div class="category-content no-padding">
                        @include('layouts.menu.admin')
                    </div>
                </div>
            </div>
        </div>
        
        @yield('secondary-sidebar')
        
        <div class="content-wrapper">
            <div class="page-header page-header-default">
                <div class="page-header-content">
                    @yield('header')
                    <a class="heading-elements-toggle"><i class="icon-more"></i></a>
                </div>
                @hasSection('secondary-header')
                <div class="breadcrumb-line">
                    @yield('secondary-header')
                    <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
                </div>
                @endif
            </div>
            <div class="loading">
                <div class="rect1"></div>
                <div class="rect2"></div>
                <div class="rect3"></div>
                <div class="rect4"></div>
                <div class="rect5"></div>
            </div>
            <div class="content" style="visibility:hidden ">
                @yield('content')

                <div class="footer text-muted">
                    {{ trans('app.footer', ['year' => date('Y'), 'name' => config('app.name')]) }}
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ elixir('assets/js/admin.js') }}"></script>
<script src="{{ env('APP_SOCKET_URL') }}/socket.io/socket.io.js"></script>
@yield('scripts')
{!! flash_messages() !!}
</body>
</html>
