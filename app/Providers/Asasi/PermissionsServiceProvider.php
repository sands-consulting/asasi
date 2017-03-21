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
                    ->name('permission.restore');
                $router->get('permissions/{permission}/revisions', 'PermissionsController@revisions')
                    ->name('permission.revisions');
                $router->get('permissions/{permission}/histories', 'PermissionsController@histories')
                    ->name('permission.histories');
                $router->get('permissions/archives', 'PermissionsController@archives')
                    ->name('permission.archives');
                $router->put('permissions/{permission}/duplicate', 'PermissionsController@duplicate')
                    ->name('permission.duplicate');
                $router->resource('permissions', 'PermissionsController');
            });
        });
    }
}
