
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-param" content="_token">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@hasSection('page-title')@yield('page-title') | @endif{{ config('app.name') }}</title>
<link href="{{ elixir('assets/css/admin.css') }}" rel="stylesheet">
</head>
<body class="navbar-top">
<div class="navbar navbar-inverse navbar-fixed-top bg-blue-700">
    <div class="navbar-boxed">
        <div class="navbar-header">
            <a class="navbar-brand prompt" href="{{ url('/') }}">
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
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if(Auth::guest())
                <li><a href="{{ url('login') }}">{{ trans('menu.login') }}</a></li>
                <li><a href="{{ url('register') }}">{{ trans('menu.register') }}</a></li>
                @else
                <li class="dropdown dropdown-user">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        {!! Gravatar::image(Auth::user()->email, Auth::user()->name, ['width' => 34, 'height' => 34]) !!}
                        <span>{{ Auth::user()->name }}</span>
                        <i class="caret"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right">
                        <li>
                            <a href="{{ route('profile') }}">
                                <i class="icon-user"></i> {{ trans('menu.my_profile') }}
                            </a>
                        </li>
                        @if(session('original_user_id'))
                        <li>
                            <a href="{{ route('profile.resume') }}" data-method="POST">
                                <i class="icon-user-cancel"></i> {{ trans('menu.release_user') }}
                            </a>
                        </li>
                        @endif
                        <li>
                            <a href="{{ url('logout') }}">
                                <i class="icon-switch2"></i> {{ trans('menu.sign_out') }}
                            </a>
                        </li>
                    </ul>
                </li>
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
                            <a href="#user-nav" data-toggle="collapse">
                                <span>{{ Auth::user()->name }}</span> <i class="caret"></i>
                            </a>
                        </div>
                    </div>
                        
                    <div class="navigation-wrapper collapse" id="user-nav">
                        <ul class="navigation">
                            <li>
                                <a href="{{ route('profile') }}">
                                    <i class="icon-user"></i> <span>{{ trans('menu.my_profile') }}</span>
                                </a>
                            </li>
                            @if(session('original_user_id'))
                            <li>
                                <a href="{{ route('profile.resume') }}" data-method="POST">
                                    <i class="icon-user-cancel"></i> {{ trans('menu.release_user') }}
                                </a>
                            </li>
                            @endif
                            <li>
                                <a href="{{ url('logout') }}">
                                    <i class="icon-switch2"></i> <span>{{ trans('menu.sign_out') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="sidebar-category sidebar-category-visible">
                    <div class="category-content no-padding">
                        <ul class="navigation navigation-main navigation-accordion">
                            <li class="{{ is_path_active('admin') }}">
                                <a href="{{ route('admin') }}"><i class="icon-home4"></i><span>{{ trans('menu.dashboard') }}</span></a>
                            </li>
                            <li class="navigation-header">                               
                                <span>{{ trans('menu.administration') }}</span> <i class="icon-menu" title="{{ trans('menu.administration') }}" data-original-title="{{ trans('menu.administration') }}"></i>
                            </li>
                            @if(Auth::user()->hasPermission('user:index'))
                            <li class="{{ is_path_active('admin/users*') }}">
                                <a href="{{ route('admin.users.index') }}"><i class="icon-users"></i> <span>{{ trans('menu.users') }}</span></a>
                            </li>
                            @endif
                            @if(Auth::user()->hasPermission('role:index'))
                            <li class="{{ is_path_active('admin/roles*') }}">
                                <a href="{{ route('admin.roles.index') }}"><i class="icon-user-tie"></i> <span>{{ trans('menu.roles') }}</span></a>
                            </li>
                            @endif
                            @if(Auth::user()->hasPermission('permission:index'))
                            <li class="{{ is_path_active('admin/permissions*') }}">
                                <a href="{{ route('admin.permissions.index') }}"><i class="icon-unlocked2"></i> <span>{{ trans('menu.permissions') }}</span></a>
                            </li>
                            @endif
                            @if(Auth::user()->hasPermission('organization:index'))
                            <li class="{{ is_path_active('admin/organizations*') }}">
                                <a href="{{ route('admin.organizations.index') }}"><i class="icon-office"></i> <span>{{ trans('menu.organizations') }}</span></a>
                            </li>
                            @endif
                            @if(Auth::user()->hasPermission('vendors:index'))
                            <li class="{{ is_path_active('admin/vendors*') }}">
                                <a href="{{ route('admin.vendors.index') }}"><i class="icon-people"></i> <span>{{ trans('menu.vendors') }}</span></a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>

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

            <div class="content">
                @yield('content')

                <div class="footer text-muted">
                    {{ trans('app.footer', ['year' => date('Y'), 'name' => config('app.name')]) }}
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ elixir('assets/js/admin.js') }}"></script>
@yield('scripts')
{!! flash_messages() !!}
</body>
</html>
