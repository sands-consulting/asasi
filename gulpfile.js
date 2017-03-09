const elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir(function(mix) {

  mix
    .less('portal.less', 'public/assets/css/portal.css')
    .less('window.less', 'public/assets/css/window.css')
    .less('admin.less', 'public/assets/css/admin.css')
    .less('print.less', 'public/assets/css/print.css')

    .scripts([
        '../../../node_modules/jquery/dist/jquery.js',
        '../../../node_modules/bootstrap-less/js/bootstrap.js',
        '../../../node_modules/pace-progress/pace.js',
        '../../../node_modules/jquery-ujs/src/rails.js',
        '../../../node_modules/datatables.net/js/jquery.dataTables.js',
        '../../../node_modules/datatables.net-buttons/js/dataTables.buttons.js',
        '../../../node_modules/jquery.nicescroll/jquery.nicescroll.js',
        '../../../node_modules/vue/dist/vue.js',
        '../../../node_modules/vue-resource/dist/vue-resource.min.js',
        '../../../node_modules/pnotify/dist/pnotify.js',
        '../../../node_modules/legitRipple.js/js/ripple.js',
        '../../../node_modules/moment/moment.js',
        '../../../node_modules/select2/dist/js/select2.js',
        'vendor/d3.min.js',
        'vendor/c3.min.js',
        'vendor/pnotify.min.js',
        'vendor/pickers/daterangepicker.js',
        'vendor/uniform.min.js',
        'vendor/buttons.server-side.js',
        'vendor/limitless-four.js',
        'vendor/pnotify.js',
        'vendor/nicescroll.js',
        'vendor/jquery-news-box/jquery.bootstrap.newsbox.js',
        'notification.js',
        'vendor.js',
        'portal.js',
    ], 'public/assets/js/portal.js')

    .scripts([
        '../../../node_modules/jquery/dist/jquery.js',
        '../../../node_modules/bootstrap-less/js/bootstrap.js',
        '../../../node_modules/pace-progress/pace.js',
        '../../../node_modules/jquery-ujs/src/rails.js',
        '../../../node_modules/datatables.net/js/jquery.dataTables.js',
        '../../../node_modules/datatables.net-buttons/js/dataTables.buttons.js',
        '../../../node_modules/jquery.nicescroll/jquery.nicescroll.js',
        '../../../node_modules/vue/dist/vue.js',
        '../../../node_modules/vue-resource/dist/vue-resource.min.js',
        '../../../node_modules/c3/c3.js',
        '../../../node_modules/pnotify/dist/pnotify.js',
        '../../../node_modules/legitRipple.js/js/ripple.js',
        '../../../node_modules/moment/moment.js',
        '../../../node_modules/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.js',
        'vendor/d3.min.js',
        'vendor/c3.min.js',
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
        'vendor/stepy.js',
        'notification.js',
        'vendor.js',
        'admin.js',
    ], 'public/assets/js/admin.js')

    .scripts([
        '../../../node_modules/jquery/dist/jquery.js',
        '../../../node_modules/bootstrap-less/js/bootstrap.js',
        '../../../node_modules/pace-progress/pace.js',
        '../../../node_modules/jquery-ujs/src/rails.js',
        '../../../node_modules/datatables.net/js/jquery.dataTables.js',
        '../../../node_modules/datatables.net-buttons/js/dataTables.buttons.js',
        '../../../node_modules/jquery.nicescroll/jquery.nicescroll.js',
        '../../../node_modules/vue/dist/vue.js',
        '../../../node_modules/vue-resource/dist/vue-resource.min.js',
        '../../../node_modules/pnotify/dist/pnotify.js',
        '../../../node_modules/legitRipple.js/js/ripple.js',
        '../../../node_modules/moment/moment.js',
        '../../../node_modules/select2/dist/js/select2.js',
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
        'assets/css/portal.css',
        'assets/css/window.css',
        'assets/css/admin.css',
        'assets/css/print.css',
        'assets/js/portal.js',
        'assets/js/window.js',
        'assets/js/admin.js',
    ])

    .copy([
      'resources/assets/fonts',
      'resources/assets/vendor/bootstrap/fonts'
    ], 'public/assets/fonts')
    .copy('resources/assets/images', 'public/assets/images')
    .copy('resources/assets/js/pages', 'public/assets/js/pages')
    .copy('resources/assets/vendor/ckeditor', 'public/assets/ckeditor')
    .copy('resources/assets/js/vendor/dhtmlxGantt', 'public/assets/dhtmlxGantt');
});
