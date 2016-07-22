<?php

namespace App\Providers\Asasi;

use Illuminate\Support\ServiceProvider;

class RolesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        app('policy')->register('App\Http\Controllers\Admin\RolesController', 'App\Policies\RolesPolicy');
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
            $router->model('roles', 'App\Role');

            $router->group(['namespace' => 'Admin', 'prefix' => 'admin'], function ($router) {
                $router->get('roles/{roles}/logs', [
                    'as'    => 'admin.roles.logs',
                    'uses'  => 'RolesController@logs'
                ]);
                $router->get('roles/{roles}/revisions', [
                    'as'    => 'admin.roles.revisions',
                    'uses'  => 'RolesController@revisions'
                ]);
                $router->post('roles/{roles}/duplicate', [
                    'as'    => 'admin.roles.duplicate',
                    'uses'  => 'RolesController@duplicate'
                ]);
                $router->resource('roles',  'RolesController');
            });
        });
    }
}
