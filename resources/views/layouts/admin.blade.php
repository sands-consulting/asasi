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
                                        <a href="@{{ notification.link }}" class="btn border-success text-success btn-flat btn-rounded btn-icon btn-sm"><i class="icon-checkmark4"></i></a>
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
                    <a href="{{ route('home') }}">
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
                <li class="dropdown dropdown-user">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        {!! Gravatar::image(Auth::user()->email, Auth::user()->name, ['width' => 34, 'height' => 34]) !!}
                        <span>{{ Auth::user()->name }}</span>
                        <i class="caret"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right">
                        <li>
                            <a href="{{ route('profile') }}">
                                <i class="icon-user"></i> {{ trans('menu.user.my_profile') }}
                            </a>
                        </li>
                        @if(session('original_user_id'))
                        <li>
                            <a href="{{ route('profile.resume') }}" data-method="POST">
                                <i class="icon-user-cancel"></i> {{ trans('menu.user.release_user') }}
                            </a>
                        </li>
                        @endif
                        <li>
                            <a href="{{ url('logout') }}">
                                <i class="icon-switch2"></i> {{ trans('menu.user.sign_out') }}
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

                            @if(Auth::user()->hasPermission('evaluation:index'))
                            <li class="{{ is_path_active('admin/evaluations*') }}">
                                <a href="{{ route('admin.evaluations.index') }}" class="legitRipple">
                                    <i class="icon-pencil"></i> <span>{{ trans('menu.admin.manage.evaluations.index') }}</span>
                                </a>
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
                            
                            @if(Auth::user()->hasPermission('project:index'))
                            <li class="{{ is_path_active('admin/projects*') }}">
                                <a href="{{ route('admin.projects.index') }}"><i class="icon-folder-check"></i> <span>{{ trans('menu.admin.manage.projects') }}</span></a>
                            </li>
                            @endif

                            @if(Auth::user()->hasPermission('subscription:index'))
                            <li class="{{ is_path_active('admin/subscriptions*') }}">
                                <a href="{{ route('admin.subscriptions.index') }}"><i class="icon-envelope"></i> <span>{{ trans('menu.admin.manage.subscriptions') }}</span></a>
                            </li>
                            @endif

                            @if(Auth::user()->hasPermission('vendor:index'))
                            <li class="{{ is_path_active('admin/vendors*') }}">
                                <a href="{{ route('admin.vendors.index') }}" class="legitRipple">
                                    <i class="icon-office"></i> <span>{{ trans('menu.admin.manage.vendors') }}</span>
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

                            @if(Auth::user()->hasPermission('package:index'))
                            <li class="{{ is_path_active('admin/packages*') }}">
                                <a href="{{ route('admin.packages.index') }}"><i class="icon-stack3"></i> <span>{{ trans('menu.admin.administration.packages') }}</span></a>
                            </li>
                            @endif

                            @if(Auth::user()->hasPermissions(['qualification-code:index', 'qualification-code-type:index']))
                            <li class="{{is_path_active(['admin/qualification-codes*', 'admin/qualification-code-types*']) }}">
                                <a href="{{ route('admin.qualification-codes.index') }}" class="has-ul legitRipple">
                                    <i class="icon-drawer3"></i> <span>{{ trans('menu.admin.administration.qualification-codes') }}</span>
                                </a>
                                <ul class="hidden-ul">
                                    <li class="{{ is_path_active('admin/qualification-codes*') }}">
                                        <a href="{{ route('admin.qualification-codes.index') }}" class="legitRipple">{{ trans('menu.admin.administration.qualification-codes') }}</a>
                                    </li>
                                    <li class="{{ is_path_active('admin/qualification-code-types*') }}">
                                        <a href="{{ route('admin.qualification-code-types.index') }}" class="legitRipple">{{ trans('menu.admin.administration.qualification-code-types') }}</a>
                                    </li>
                                </ul>
                            </li>
                            @endif
                            
                            @if(Auth::user()->hasPermissions(['notice-type:index', 'notice-category:index']))
                            <li class="{{is_path_active(['admin/qualification-codes*', 'admin/qualification-code-types*']) }}">
                                <a href="{{ route('admin.notice-types.index') }}" class="has-ul legitRipple">
                                    <i class="icon-clipboard"></i> <span>{{ trans('menu.admin.administration.notices') }}</span>
                                </a>
                                <ul class="hidden-ul">
                                    <li class="{{ is_path_active('admin/notice-types*') }}">
                                        <a href="{{ route('admin.notice-types.index') }}" class="legitRipple">{{ trans('menu.admin.administration.notice-types') }}</a>
                                    </li>
                                    <li class="{{ is_path_active('admin/notice-categories*') }}">
                                        <a href="{{ route('admin.notice-categories.index') }}" class="legitRipple">{{ trans('menu.admin.administration.notice-categories') }}</a>
                                    </li>
                                </ul>
                            </li>
                            @endif

                            @if(Auth::user()->hasPermission('place:index'))
                            <li class="{{ is_path_active('admin/places*') }}">
                                <a href="{{ route('admin.places.index') }}"><i class="icon-city"></i> <span>{{ trans('menu.admin.administration.places') }}</span></a>
                            </li>
                            @endif

                            <li class="navigation-header">                               
                                <span>{{ trans('menu.admin.settings.title') }}</span> <i class="icon-cogs" title="{{ trans('menu.admin.settings.title') }}" data-original-title="{{ trans('menu.admin.settings.title') }}"></i>
                            </li>
                            
                            @if(Auth::user()->hasPermission('payment-gateways:index'))
                            <li class="{{ is_path_active('admin/payment-gateways*') }}">
                                <a href="{{ route('admin.organizations.index') }}"><i class="icon-cog3"></i> <span>{{ trans('menu.admin.settings.payment-gateways') }}</span></a>
                            </li>
                            @endif

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
<script src="http://prompt.demo.my-sands.com:3000/socket.io/socket.io.js"></script>
@yield('scripts')
{!! flash_messages() !!}
</body>
</html>
