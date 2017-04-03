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
    <link href="{{ elixir('assets/css/portal.css') }}" rel="stylesheet"/>
    <script>
      window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body class="{{ body_classes('navbar-top layout-boxed portal') }}">
<div class="navbar navbar-fixed-top bg-white">
	<div class="navbar-boxed">
		<div class="navbar-header">
			<a class="navbar-brand prompt" href="{{ route('root') }}">
                {{ config('app.name') }}
            </a>

			<ul class="nav navbar-nav visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
            <ul class="nav navbar-nav navbar-right">
                @include('layouts.menu.access')
				@include('layouts.menu.cart')
                @include('layouts.menu.notifications')
				@include('layouts.menu.user')
			</ul>
		</div>
	</div>
</div>

@hasSection('ahead')
@yield('ahead')
@endif

@include('layouts.portal.widgets.wizard')

<div class="page-container">
	<div class="page-content">
    	@yield('content')
    </div>
</div>

<div class="footer text-center text-muted">
	{{ trans('app.footer', ['year' => date('Y'), 'name' => config('app.name')]) }}
</div>

<script src="{{ elixir('assets/js/portal.js') }}"></script>
<script src="{{ env('APP_SOCKET_URL') }}/socket.io/socket.io.js"></script>
@yield('scripts')
{!! flash_messages() !!}
</body>
</html>
