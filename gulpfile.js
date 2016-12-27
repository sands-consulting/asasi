var elixir = require('laravel-elixir');

require('laravel-elixir-vue');
require('laravel-elixir-livereload');

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
    .less('window.less', 'public/assets/css/window.css')
    .less('admin.less', 'public/assets/css/admin.css')
    .less('print.less', 'public/assets/css/print.css');

  mix
    .scripts([
        '../vendor/jquery/dist/jquery.js',
        '../vendor/PACE/pace.js',
        '../vendor/jquery-ujs/src/rails.js',
        '../vendor/bootstrap/dist/js/bootstrap.js',
        '../vendor/datatables.net/js/jquery.dataTables.js',
        // '../vendor/datatables/media/js/jquery.dataTables.js',
        '../vendor/datatables.net-buttons/js/dataTables.buttons.min.js',
        '../vendor/jquery.nicescroll/dist/jquery.nicescroll.min.js',
        '../vendor/d3/d3.js',
        '../vendor/c3/c3.js',
        '../vendor/vue/dist/vue.js',
        '../vendor/vue-resource/dist/vue-resource.min.js',
        '../vendor/pnotify/dist/pnotify.js',
        '../vendor/legitripple/js/ripple.js',
        '../vendor/moment/moment.js',
        '../vendor/select2/dist/js/select2.js',
        'vendor/pnotify.min.js',
        'vendor/pickers/daterangepicker.js',
        'vendor/uniform.min.js',
        'vendor/buttons.server-side.js',
        'vendor/limitless-four.js',
        'vendor/pnotify.js',
        'vendor/nicescroll.js',
        'notification.js',
        'vendor.js',
        'public.js',
    ], 'public/assets/js/public.js')

    .scripts([
        '../vendor/jquery/dist/jquery.js',
        '../vendor/PACE/pace.js',
        '../vendor/jquery-ujs/src/rails.js',
        '../vendor/bootstrap/dist/js/bootstrap.js',
        '../vendor/datatables/media/js/jquery.dataTables.js',
        '../vendor/jquery.nicescroll/dist/jquery.nicescroll.min.js',
        '../vendor/stepy/lib/jquery.stepy.js',
        '../vendor/d3/d3.js',
        '../vendor/c3/c3.js',
        '../vendor/vue/dist/vue.js',
        '../vendor/vue-resource/dist/vue-resource.min.js',
        // '../vendor/pnotify/dist/pnotify.js',
        '../vendor/legitripple/js/ripple.js',
        '../vendor/moment/moment.js',
        '../vendor/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.js',
        'vendor/switchery.min.js',
        'vendor/limitless-one.js',
        'vendor/select2.min.js',
        'vendor/pnotify.min.js',
        'vendor/pnotify.js',
        'vendor/nicescroll.js',
        'vendor/uniform.min.js',
        'vendor/validate.min.js',
        'vendor/pickers/daterangepicker.js',
        'vendor/x-editable/input-ext/single-switchery.js',
        'vendor/x-editable/input-ext/daterangepicker.js',
        'vendor/notice_wizard.js',
        'vendor/form_select2.js',
        'vendor/picker_date.js',
        'pages/admin.dashboard.user.js',
        'notification.js',
        'vendor.js',
        'admin.js',
    ], 'public/assets/js/admin.js')

    .scripts([
        '../vendor/PACE/pace.js',
        '../vendor/jquery/dist/jquery.js',
        '../vendor/jquery-ujs/src/rails.js',
        '../vendor/bootstrap/dist/js/bootstrap.js',
        '../vendor/datatables.net/js/jquery.dataTables.js',
        '../vendor/datatables.net-buttons/js/dataTables.buttons.min.js',
        '../vendor/jquery.nicescroll/dist/jquery.nicescroll.min.js',
        '../vendor/vue/dist/vue.js',
        '../vendor/vue-resource/dist/vue-resource.min.js',
        '../vendor/pnotify/dist/pnotify.js',
        '../vendor/legitripple/js/ripple.js',
        '../vendor/moment/moment.js',
        '../vendor/select2/dist/js/select2.js',
        'vendor/pnotify.min.js',
        'vendor/pickers/daterangepicker.js',
        'vendor/uniform.min.js',
        'vendor/buttons.server-side.js',
        'vendor/limitless-four.js',
        'vendor/pnotify.js',
        'vendor/nicescroll.js',
        'window.js',
    ], 'public/assets/js/window.js')

    .version([
        'assets/css/public.css',
        'assets/css/window.css',
        'assets/css/admin.css',
        'assets/css/print.css',
        'assets/js/public.js',
        'assets/js/window.js',
        'assets/js/admin.js',
    ])
    .copy([
      'resources/assets/fonts',
      'resources/assets/vendor/bootstrap/fonts'
    ], 'public/assets/fonts')

    .copy('resources/assets/images', 'public/assets/images')

    .copy('resources/assets/vendor/ckeditor', 'public/assets/ckeditor')

    .copy('resources/assets/js/vendor/dhtmlxGantt', 'public/assets/dhtmlxGantt');
});
