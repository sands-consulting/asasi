var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
  // styles
  mix
    .less('public.less', 'public/assets/css/public.css')
    .less('admin.less', 'public/assets/css/admin.css');

  mix
    .scripts([
        '../vendor/PACE/pace.js',
        '../vendor/jquery/dist/jquery.js',
        '../vendor/jquery-ujs/src/rails.js',
        '../vendor/bootstrap/dist/js/bootstrap.js',
        '../vendor/jquery.nicescroll/dist/jquery.nicescroll.min.js',
        '../vendor/d3/d3.js',
        '../vendor/c3/c3.js',
        '../vendor/noty/js/noty/jquery.noty.js',
        '../vendor/pnotify/dist/pnotify.js',
        'public.js',
    ], 'public/assets/js/public.js')
    .scripts([
        '../vendor/PACE/pace.js',
        '../vendor/jquery/dist/jquery.js',
        '../vendor/jquery-ujs/src/rails.js',
        '../vendor/bootstrap/dist/js/bootstrap.js',
        '../vendor/jquery.nicescroll/dist/jquery.nicescroll.min.js',
        '../vendor/d3/d3.js',
        '../vendor/c3/c3.js',
        '../vendor/noty/js/noty/jquery.noty.js',
        '../vendor/pnotify/dist/pnotify.js',
        'admin.js',
    ], 'public/assets/js/admin.js')
    .version([
        'assets/css/public.css',
        'assets/css/admin.css',
        'assets/js/public.js',
        'assets/js/admin.js',
    ])
    .copy([
      'resources/assets/fonts',
      'resources/assets/vendor/bootstrap/fonts'
    ], 'public/assets/fonts')
    .copy('resources/assets/images', 'public/assets/images')
});
