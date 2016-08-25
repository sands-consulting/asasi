<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-param" content="_token">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@hasSection('page-title')@yield('page-title') | @endif{{ config('app.name') }}</title>
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
				<li class="dropdown">
					<a href="#" class="dropdown-toggle legitRipple" data-toggle="dropdown" aria-expanded="false">
						<i class="icon-cart4"></i>
						<span class="visible-xs-inline-block position-right">Cart</span>
						@if (Cart::count() > 0)
							<span class="badge bg-warning-400">{{ Cart::count() }}</span>
						@endif
					</a>
					
					<div class="dropdown-menu dropdown-content">
						<div class="dropdown-content-heading">
							Cart
							<ul class="icons-list">
								<li><a href="#"><i class="icon-cart4"></i></a></li>
							</ul>
						</div>
						
						<ul class="media-list dropdown-content-body width-350">
							@if (Cart::count() > 0)
								@foreach(Cart::content() as $cart)
								<li class="media">
									<div class="media-left">
										<i class="icon-cart-remove"></i>
									</div>
									<div class="media-body">
										<a href="#" class="media-heading">
											<span class="text-semibold">{{ $cart->name }}</span>
											<span class="media-annotation pull-right">MYR {{ $cart->price }}</span>
										</a>

										<span class="text-muted">{{ str_limit($cart->options->description, 60) }}</span>
									</div>
								</li>
								@endforeach
							@else
								<li class="media">
									<div class="media-body">
										<p class="text-center"><span class="text-muted">Cart is empty :)</span></p>
									</div>
								</li>
							@endif
						</ul>

						<div class="dropdown-content-footer">
							<a href="{{ route('carts.index') }}" data-popup="tooltip" title="" data-original-title="View Cart"><i class="icon-menu display-block"></i></a>
						</div>
					</div>	
				</li>
				@if(Auth::guest())
				<li><a href="{{ url('login') }}">{{ trans('menu.login') }}</a></li>
				<li><a href="{{ url('register') }}">{{ trans('menu.register') }}</a></li>
				@else

				@if(Auth::user()->hasPermission('access:admin'))
				<li>
					<a href="{{ route('admin') }}">
						<i class="icon-cog52"></i> {{ trans('menu.admin_area') }}
					</a>
				</li>
				@endif

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
				<li class="{{ is_path_active('/') }}">
					<a href="{{ url('/') }}" class="legitRipple">
						<i class="icon-home2 position-left"></i> {{ trans('menu.home') }}
					</a>
				</li>
				@if(Auth::user() && Auth::user()->hasPermission('access:vendor'))
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-envelop5 position-left"></i> Subscriptions <span class="caret"></span>
					</a>

					<ul class="dropdown-menu">
						<li class="{{ is_path_active('subscriptions') }}">
							<a href="{{ route('subscriptions.current') }}"><i class="icon-stack3"></i> My Package</a>
						</li>
						<li class="{{ is_path_active('subscriptions/history') }}">
							<a href="{{ route('subscriptions.history') }}"><i class="icon-history"></i> Histories</a>
						</li>
					</ul>
				</li>
				@endif
			</ul>
		</div>
	</div>
</div>

<div class="page-header">
	<div class="page-header-content">
		@yield('header')
	</div>
</div>

<div class="page-container">
    <div class="page-content">
    	<div class="content-wrapper">
			@yield('content')
		</div>
	</div>
</div>

<div class="footer footer-boxed text-muted">{{ trans('app.footer', ['year' => date('Y'), 'name' => config('app.name')]) }}</div>

<script src="{{ elixir('assets/js/public.js') }}"></script>
@yield('scripts')
{!! flash_messages() !!}
</body>
</html>
