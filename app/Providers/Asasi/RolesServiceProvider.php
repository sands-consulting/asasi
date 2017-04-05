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
                    ->name('roles.restore');
                $router->get('roles/{role}/revisions', 'RolesController@revisions')
                    ->name('roles.revisions');
                $router->get('roles/{role}/histories', 'RolesController@histories')
                    ->name('roles.histories');
                $router->get('roles/archives', 'RolesController@archives')
                    ->name('roles.archives');
                $router->put('roles/{role}/duplicate', 'RolesController@duplicate')
                    ->name('roles.duplicate');
                $router->resource('roles',  'RolesController');
            });
        });
    }
}
