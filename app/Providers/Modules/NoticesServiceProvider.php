<?php

namespace App\Providers\Modules;

use Illuminate\Support\ServiceProvider;

class NoticesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app('policy')->register('App\Http\Controllers\Admin\NoticesController', 'App\Policies\NoticesPolicy');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // module routing
        app('router')->group(['namespace' => 'App\Http\Controllers'], function ($router) {
            $router->model('notices', 'App\Notice');

            $router->group(['namespace' => 'Admin', 'prefix' => 'admin'], function ($router) {
                $router->put('notices/{notices}/publish', [
                    'as'    => 'admin.notices.publish',
                    'uses'  => 'NoticesController@publish'
                ]);
                $router->put('notices/{notices}/unpublish', [
                    'as'    => 'admin.notices.unpublish',
                    'uses'  => 'NoticesController@unpublish'
                ]);
                $router->get('notices/{notices}/logs', [
                    'as'    => 'admin.notices.logs',
                    'uses'  => 'NoticesController@logs'
                ]);
                $router->get('notices/{notices}/revisions', [
                    'as'    => 'admin.notices.revisions',
                    'uses'  => 'NoticesController@revisions'
                ]);
                $router->post('notices/{notices}/duplicate', [
                    'as'    => 'admin.notices.duplicate',
                    'uses'  => 'NoticesController@duplicate'
                ]);
                $router->resource('notices', 'NoticesController');
            });
        });
    }
}
