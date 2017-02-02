<?php

namespace App\Providers\Asasi;

use App\Role;
use Gate;
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
        app('policy')->register('App\Http\Controllers\Admin\RolesController', 'App\Policies\RolePolicy');

        Gate::policy("App\Role", "App\Policies\RolePolicy");
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
                $router->resource('roles',  'RolesController');
                $router->get('roles/{role}/revisions', 'RolesController@revisions')
                    ->name('roles.revisions');
            });
        });
    }
}
