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
    <script>
      window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
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
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @include('layouts.menu.access')
                @include('layouts.menu.notifications')
                @include('layouts.menu.user')
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

@include('layouts._javascript')
<script src="{{ elixir('assets/js/admin.js') }}"></script>
<script src="//{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>
<script src="{{ elixir('js/app.js') }}"></script>
@yield('scripts')
{!! flash_messages() !!}
</body>
</html>
