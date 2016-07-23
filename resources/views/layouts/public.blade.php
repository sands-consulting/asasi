
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-param" content="_token">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ config('app.name') }}</title>
<link href="{{ elixir('assets/css/public.css') }}" rel="stylesheet">
</head>
<body class="layout-boxed navbar-top">
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
						<li><a href="{{ url('account') }}"><i class="fa fa-user"></i> {{ trans('menu.my_account') }}</a></li>
						<li><a href="{{ url('logout') }}"><i class="fa fa-sign-out"></i> {{ trans('menu.sign_out') }}</a></li>
					</ul>
				</li>
				@endif
			</ul>
		</div>
	</div>
</div>

<div class="navbar navbar-default" id="navbar-second">
	<div class="navbar-boxed">
		<ul class="nav navbar-nav no-border visible-xs-block">
			<li>
				<a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle">
					<span class="sr-only">{{ trans('menu.toggle') }}</span>
                	<span class="icon-bar"></span>
                	<span class="icon-bar"></span>
                	<span class="icon-bar"></span>
				</a>
			</li>
		</ul>

		<div class="navbar-collapse collapse" id="navbar-second-toggle">
			<ul class="nav navbar-nav navbar-nav-material">
				<li><a href="{{ url('/') }}" class="legitRipple">{{ trans('menu.home') }}</a></li>
			</ul>
		</div>
	</div>
</div>

@yield('content')

<div class="footer footer-boxed text-muted">{{ trans('app.footer', ['year' => date('Y'), 'name' => config('app.name')]) }}</div>

@yield('scripts')
<script src="{{ elixir('assets/js/public.js') }}"></script>
{!! flash_messages() !!}
</body>
</html>
