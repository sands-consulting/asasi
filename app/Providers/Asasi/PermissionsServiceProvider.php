<?php

namespace App\Providers\Asasi;

<<<<<<< HEAD
=======
use App\Permission;
use Gate;
>>>>>>> upstream/5.3
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
<<<<<<< HEAD
        app('policy')->register('App\Http\Controllers\Admin\PermissionsController', 'App\Policies\PermissionsPolicy');
=======
        app('policy')->register('App\Http\Controllers\Admin\PermissionsController', 'App\Policies\PermissionPolicy');

        Gate::policy("App\Permission", "App\Policies\PermissionPolicy");
>>>>>>> upstream/5.3
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
<<<<<<< HEAD

        // module routing
        app('router')->group(['namespace' => 'App\Http\Controllers'], function ($router) {
            $router->model('permissions', 'App\Permission');

            $router->group(['namespace' => 'Admin', 'prefix' => 'admin'], function ($router) {
                $router->resource('permissions',  'PermissionsController', ['only' => 'index']);
=======
        // module routing
        app('router')->group(['namespace' => 'App\Http\Controllers'], function ($router) {
            $router->group(['prefix' => 'admin', 'namespace' => 'Admin'], function($router) {
                $router->resource('permissions', 'PermissionsController');
>>>>>>> upstream/5.3
            });
        });
    }
}
