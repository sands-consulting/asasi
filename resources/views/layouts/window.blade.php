
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
<body class="login-container">
<div class="page-container">
	<div class="page-content">
		<div class="content-wrapper">
            <!-- start: header -->
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                    <div class="login-header text-center">
                        <img class="prompt-logo" src="/assets/images/logo-white.svg" alt="">
                        <div class="col-xs-12 login-header-tagline">
                            <span>Procurement Management For Projects and Tenders</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end: header -->
			@yield('content')
		</div>
	</div>
</div>
<div class="footer footer-boxed text-muted text-center">
	{{ trans('app.footer', ['year' => date('Y'), 'name' => config('app.name')]) }} | All Rights Reserved.
</div>

<script src="{{ elixir('assets/js/public.js') }}"></script>
@yield('scripts')
{!! flash_messages() !!}
</body>
</html>
