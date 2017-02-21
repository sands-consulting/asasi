<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-param" content="_token">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="socket-url" content="{{ env('APP_SOCKET_URL') }}">
<title>@hasSection('page-title')@yield('page-title') | @endif{{ config('app.name') }}</title>
<link href="{{ elixir('assets/css/window.css') }}" rel="stylesheet">
</head>
<body>
<div class="page-container">
	<div class="page-content">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                <a href="{{ route('contact') }}" class="window-header hidden-print">{{ config('app.description') }}</a>
    			@yield('content')
            </div>
		</div>
	</div>
</div>

<div class="footer footer-boxed text-muted text-center">
	{{ trans('app.footer', ['year' => date('Y'), 'name' => config('app.name')]) }}
</div>

<script src="{{ elixir('assets/js/public.js') }}"></script>
<script src="{{ env('APP_SOCKET_URL') }}/socket.io/socket.io.js"></script>
@yield('scripts')
{!! flash_messages() !!}
</body>
</html>
