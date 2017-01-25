<?php

namespace App\Providers\Asasi;

<<<<<<< HEAD
=======
use App\Role;
use Gate;
>>>>>>> upstream/5.3
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
<<<<<<< HEAD
        app('policy')->register('App\Http\Controllers\Admin\RolesController', 'App\Policies\RolesPolicy');
=======
        app('policy')->register('App\Http\Controllers\Admin\RolesController', 'App\Policies\RolePolicy');

        Gate::policy("App\Role", "App\Policies\RolePolicy");
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
            $router->model('roles', 'App\Role');

            $router->group(['namespace' => 'Admin', 'prefix' => 'admin'], function ($router) {
                $router->get('roles/{roles}/revisions', [
                    'as'    => 'admin.roles.revisions',
                    'uses'  => 'RolesController@revisions'
                ]);
                $router->resource('roles',  'RolesController');
=======
        // module routing
        app('router')->group(['namespace' => 'App\Http\Controllers'], function ($router) {
            $router->group(['prefix' => 'admin', 'namespace' => 'Admin'], function($router) {
                $router->resource('roles', 'RolesController');
>>>>>>> upstream/5.3
            });
        });
    }
}
