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

        app('policy')->register('App\Http\Controllers\Admin\PermissionsController',
            'App\Policies\Asasi\PermissionPolicy');
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
                $router->put('permissions/{permission}/restore', 'PermissionsController@restore')
                    ->name('permissions.restore');
                $router->get('permissions/{permission}/revisions', 'PermissionsController@revisions')
                    ->name('permissions.revisions');
                $router->get('permissions/{permission}/histories', 'PermissionsController@histories')
                    ->name('permissions.histories');
                $router->get('permissions/archives', 'PermissionsController@archives')
                    ->name('permissions.archives');
                $router->put('permissions/{permission}/duplicate', 'PermissionsController@duplicate')
                    ->name('permissions.duplicate');
                $router->resource('permissions', 'PermissionsController');
            });
        });
    }
}
