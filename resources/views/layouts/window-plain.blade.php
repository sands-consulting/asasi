<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-param" content="_token">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="socket-url" content="{{ env('APP_SOCKET_URL') }}">
<title>@hasSection('page-title')@yield('page-title') | @endif{{ trans('app.admin') }} | {{ setting('app_name') }}</title>
<link href="{{ elixir('assets/css/admin.css') }}" rel="stylesheet">
</head>
<body class="v-cloak">

<div class="page-container">
    <div class="page-content">
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
                    {{ trans('app.footer', ['year' => date('Y'), 'name' => setting('app_name')]) }}
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ elixir('assets/js/window.js') }}"></script>
<script src="{{ env('APP_SOCKET_URL') }}/socket.io/socket.io.js"></script>
@yield('scripts')
{!! flash_messages() !!}
</body>
</html>
