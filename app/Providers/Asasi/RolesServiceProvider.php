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
        Gate::policy('App\Role', 'App\Policies\Asasi\RolePolicy');

        app('policy')->register('App\Http\Controllers\Admin\RolesController', 'App\Policies\RolePolicy');
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
                $router->put('roles/{role}/restore', 'RolesController@restore')
                    ->name('role.restore');
                $router->get('roles/{role}/revisions', 'RolesController@revisions')
                    ->name('role.revisions');
                $router->get('roles/{role}/histories', 'RolesController@histories')
                    ->name('role.histories');
                $router->get('roles/archives', 'RolesController@archives')
                    ->name('role.archives');
                $router->put('roles/{role}/duplicate', 'RolesController@duplicate')
                    ->name('role.duplicate');
                $router->resource('roles',  'RolesController');
            });
        });
    }
}
