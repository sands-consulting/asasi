<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-param" content="_token">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@hasSection('page-title')@yield('page-title') | @endif{{ trans('app.admin') }} | {{ config('app.name') }}</title>
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
                <li>
                    <a href="{{ route('home.index') }}">
                        <i class="icon-atom2"></i> {{ trans('menu.public_site') }}
                    </a>
                </li>

                @if(Auth::user()->hasPermission('access:report'))
                <li>
                    <a href="{{ route('admin') }}">
                        <i class="icon-file-text"></i> {{ trans('menu.report') }}
                    </a>
                </li>
                @endif
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
                                    <i class="icon-user-cancel"></i> <span>{{ trans('menu.release_user') }}</span>
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
                                <span>{{ trans('menu.admin.manage.title') }}</span> <i class="icon-menu" title="{{ trans('menu.admin.manage.title') }}" data-original-title="{{ trans('menu.admin.manage.title') }}"></i>
                            </li>

                            @if(Auth::user()->hasPermission('allocation:index'))
                            <li class="{{ is_path_active('admin/allocations*') }}">
                                <a href="{{ route('admin.allocations.index') }}"><i class="icon-coins"></i> <span>{{ trans('menu.admin.manage.allocations') }}</span></a>
                            </li>
                            @endif

                            @if(Auth::user()->hasPermission('news:index'))
                            <li class="{{ is_path_active('admin/news*') }}">
                                <a href="{{ route('admin.news.index') }}"><i class="icon-newspaper"></i> <span>{{ trans('menu.admin.manage.news') }}</span></a>
                            </li>
                            @endif
                            
                            @if(Auth::user()->hasPermission('notice:index'))
                            <li class="{{ is_path_active('admin/notices*') }}">
                                <a href="{{ route('admin.notices.index') }}"><i class="icon-clipboard3"></i> <span>{{ trans('menu.admin.manage.notices') }}</span></a>
                            </li>
                            @endif

                            @if(Auth::user()->hasPermission('package:index'))
                            <li class="{{ is_path_active('admin/packages*') }}">
                                <a href="{{ route('admin.packages.index') }}"><i class="icon-stack3"></i> <span>{{ trans('menu.admin.manage.packages') }}</span></a>
                            </li>
                            @endif
                            
                            @if(Auth::user()->hasPermission('vendor:index'))
                            <li class="{{ is_path_active('admin/submissions*') }}">
                                <a href="{{ route('admin.submissions.index') }}" class="legitRipple">
                                    <i class="icon-mailbox"></i> <span>{{ trans('menu.admin.manage.submissions') }}</span>
                                </a>
                            </li>
                            @endif

                            @if(Auth::user()->hasPermission('vendor:index'))
                            <li class="{{ is_path_active('admin/vendors*') }}">
                                <a href="{{ route('admin.vendors.index') }}" class="legitRipple">
                                    <i class="icon-people"></i> <span>{{ trans('menu.admin.manage.vendors') }}</span>
                                </a>
                            </li>
                            @endif

                            <li class="navigation-header">                               
                                <span>{{ trans('menu.admin.administration.title') }}</span> <i class="icon-menu" title="{{ trans('menu.admin.administration.title') }}" data-original-title="{{ trans('menu.admin.administration.title') }}"></i>
                            </li>

                            @if(Auth::user()->hasPermission('user:index'))
                            <li class="{{ is_path_active('admin/users*') }}">
                                <a href="{{ route('admin.users.index') }}"><i class="icon-users"></i> <span>{{ trans('menu.admin.administration.users') }}</span></a>
                            </li>
                            @endif

                            @if(Auth::user()->hasPermission('role:index'))
                            <li class="{{ is_path_active('admin/roles*') }}">
                                <a href="{{ route('admin.roles.index') }}"><i class="icon-user-tie"></i> <span>{{ trans('menu.admin.administration.roles') }}</span></a>
                            </li>
                            @endif

                            @if(Auth::user()->hasPermission('permission:index'))
                            <li class="{{ is_path_active('admin/permissions*') }}">
                                <a href="{{ route('admin.permissions.index') }}"><i class="icon-unlocked2"></i> <span>{{ trans('menu.admin.administration.permissions') }}</span></a>
                            </li>
                            @endif

                            @if(Auth::user()->hasPermission('organization:index'))
                            <li class="{{ is_path_active('admin/organizations*') }}">
                                <a href="{{ route('admin.organizations.index') }}"><i class="icon-grid5"></i> <span>{{ trans('menu.admin.administration.organizations') }}</span></a>
                            </li>
                            @endif

                            @if(Auth::user()->hasPermission('place:index'))
                            <li class="{{ is_path_active('admin/places*') }}">
                                <a href="{{ route('admin.places.index') }}"><i class="icon-city"></i> <span>{{ trans('menu.admin.administration.places') }}</span></a>
                            </li>
                            @endif

                            @if(Auth::user()->hasPermission('qualification-code:index'))
                            <li class="{{ is_path_active('admin/qualification-codes*') }}">
                                <a href="{{ route('admin.qualification-codes.index') }}"><i class="icon-drawer3"></i> <span>{{ trans('menu.admin.administration.qualification-codes') }}</span></a>
                            </li>
                            @endif
                            
                            @if(Auth::user()->hasPermission('notice-type:index'))
                            <li class="{{ is_path_active('admin/notice_types*') }}">
                                <a href="{{ route('admin.notice-types.index') }}"><i class="icon-clipboard"></i> <span>{{ trans('menu.admin.administration.notice-types') }}</span></a>
                            </li>
                            @endif
                            @if(Auth::user()->hasPermission('notice-category:index'))
                            <li class="{{ is_path_active('admin/notice_categories*') }}">
                                <a href="{{ route('admin.notice-categories.index') }}"><i class="icon-clipboard"></i> <span>{{ trans('menu.admin.administration.notice-categories') }}</span></a>
                            </li>
                            @endif

                            <li class="navigation-header">                               
                                <span>{{ trans('menu.admin.settings.title') }}</span> <i class="icon-cogs" title="{{ trans('menu.admin.settings.title') }}" data-original-title="{{ trans('menu.admin.settings.title') }}"></i>
                            </li>

                            <li class="{{ is_path_active('admin/payment-gateways*') }}">
                                <a href="{{ route('admin.organizations.index') }}"><i class="icon-cog3"></i> <span>{{ trans('menu.admin.settings.payment-gateways') }}</span></a>
                            </li>

                            @if(Auth::user()->hasPermission('allocation-type:index'))
                            <li class="{{ is_path_active('admin/allocation-types*') }}">
                                <a href="{{ route('admin.allocation-types.index') }}"><i class="icon-cog3"></i> <span>{{ trans('menu.admin.settings.allocation-types') }}</span></a>
                            </li>
                            @endif

                            @if(Auth::user()->hasPermission('news-category:index'))
                            <li class="{{ is_path_active('admin/news-categories*') }}">
                                <a href="{{ route('admin.news-categories.index') }}"><i class="icon-cog3"></i> <span>{{ trans('menu.admin.settings.news-categories') }}</span></a>
                            </li>
                            @endif

                            @if(Auth::user()->hasPermission('vendor-type:index'))
                            <li class="{{ is_path_active('admin/vendor-types*') }}">
                                <a href="{{ route('admin.vendor-types.index') }}"><i class="icon-cog3"></i> <span>{{ trans('menu.admin.settings.vendor-types') }}</span></a>
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
            <div class="sk-fading-circle">
              <div class="sk-circle1 sk-circle"></div>
              <div class="sk-circle2 sk-circle"></div>
              <div class="sk-circle3 sk-circle"></div>
              <div class="sk-circle4 sk-circle"></div>
              <div class="sk-circle5 sk-circle"></div>
              <div class="sk-circle6 sk-circle"></div>
              <div class="sk-circle7 sk-circle"></div>
              <div class="sk-circle8 sk-circle"></div>
              <div class="sk-circle9 sk-circle"></div>
              <div class="sk-circle10 sk-circle"></div>
              <div class="sk-circle11 sk-circle"></div>
              <div class="sk-circle12 sk-circle"></div>
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
@yield('scripts')
{!! flash_messages() !!}
</body>
</html>
