<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@hasSection('page-title')@yield('page-title') | @endif{{ config('app.name') }}</title>
{{ Html::style(elixir('assets/css/print.css')) }}
</head>
<body class="layout-boxed navbar-top">
    @yield('content')
    <div class="footer footer-boxed text-muted">{{ trans('app.footer', ['year' => date('Y'), 'name' => config('app.name')]) }}</div>
</body>
</html>
