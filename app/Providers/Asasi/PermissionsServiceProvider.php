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
        app('policy')->register('App\Http\Controllers\Admin\PermissionsController', 'App\Policies\PermissionPolicy');

        Gate::policy("App\Permission", "App\Policies\PermissionPolicy");
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
            $router->group(['prefix' => 'admin', 'namespace' => 'Admin'], function($router) {
                $router->resource('permissions', 'PermissionsController');
            });
        });
    }
}
