<?php

namespace App\Providers\Asasi;

use App\Permission;
use Gate;
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
        Gate::policy('App\Permission', 'App\Policies\Asasi\PermissionPolicy');

        app('policy')->register('App\Http\Controllers\Admin\PermissionsController', 'App\Policies\PermissionPolicy');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // module routing
        app('router')->group([
            'namespace' => 'App\Http\Controllers',
            'middleware' => 'web'
        ], function ($router) {
            $router->group([
                'namespace' => 'Admin',
                'prefix' => 'admin',
                'as' => 'admin.'
            ], function ($router) {
                $router->resource('permissions', 'PermissionsController');
            });
        });
    }
}
