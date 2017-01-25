<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-param" content="_token">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="socket-url" content="{{ env('SOCKET_URL') }}">
<title>@hasSection('page-title')@yield('page-title') | @endif{{ config('app.name') }}</title>
<link href="{{ elixir('assets/css/public.css') }}" rel="stylesheet">
</head>
<body class="{{ body_classes('navbar-top layout-boxed public') }}">
<div class="navbar navbar-inverse navbar-fixed-top bg-blue-700">
	<div class="navbar-boxed">
		<div class="navbar-header">
			<a class="navbar-brand prompt" href="{{ route('home') }}">
                {{ config('app.name') }}
            </a>

			<ul class="nav navbar-nav visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav">
                @if (Auth::user())
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
                                        <a href="@{{ notification.link }}" class="btn border-success text-success btn-flat btn-rounded btn-icon btn-sm"><i class="icon-user-plus"></i></a>
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
                @endif
            </ul>

            <ul class="nav navbar-nav navbar-right">
            	<li class="{{ is_path_active('helps') }}"><a href="{{ url('/') }}">{{ trans('menu.app.help') }}</a></li>
                <li class="{{ is_path_active('contact') }}"><a href="{{ route('contact') }}">{{ trans('menu.app.contact') }}</a></li>

                @if(Auth::user())
				@include('layouts._cart')
				@include('layouts._user')
				@endif
			</ul>
		</div>
	</div>
</div>

@hasSection('ahead')
@yield('ahead')
@endif

<div class="page-container">
	<div class="page-content">
    	@yield('content')
    </div>
</div>

<div class="footer text-center text-muted">
	{{ trans('app.footer', ['year' => date('Y'), 'name' => config('app.name')]) }}
</div>

<script src="{{ elixir('assets/js/public.js') }}"></script>
<script src="{{ env('APP_SOCKET_URL') }}/socket.io/socket.io.js"></script>
@yield('scripts')
{!! flash_messages() !!}
</body>
</html>
