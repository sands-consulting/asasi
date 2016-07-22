<?php

namespace App\Providers\Asasi;

use Illuminate\Support\ServiceProvider;

class PermissionsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        app('policy')->register('App\Http\Controllers\Admin\PermissionsController', 'App\Policies\PermissionsPolicy');
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
            $router->model('permissions', 'App\Permission');

            $router->group(['namespace' => 'Admin', 'prefix' => 'admin'], function ($router) {
                $router->get('permissions/{permissions}/logs', [
                    'as'    => 'admin.permissions.logs',
                    'uses'  => 'PermissionsController@logs'
                ]);
                $router->get('permissions/{permissions}/revisions', [
                    'as'    => 'admin.permissions.revisions',
                    'uses'  => 'PermissionsController@revisions'
                ]);
                $router->post('permissions/{permissions}/duplicate', [
                    'as'    => 'admin.permissions.duplicate',
                    'uses'  => 'PermissionsController@duplicate'
                ]);
                $router->resource('permissions',  'PermissionsController');
            });
        });
    }
}
