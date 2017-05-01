<?php

namespace App\Providers\Asasi;

use App\Organization;
use Gate;
use Illuminate\Support\ServiceProvider;

class OrganizationsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::policy('App\Organization', 'App\Policies\Asasi\OrganizationPolicy');

        app('policy')->register('App\Http\Controllers\Admin\OrganizationsController', 'App\Policies\Asasi\OrganizationPolicy');
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
                $router->put('organizations/{organization}/restore', 'OrganizationsController@restore')
                    ->name('organizations.restore');
                $router->get('organizations/{organization}/revisions', 'OrganizationsController@revisions')
                    ->name('organizations.revisions');
                $router->get('organizations/{organization}/histories', 'OrganizationsController@histories')
                    ->name('organizations.histories');
                $router->get('organizations/archives', 'OrganizationsController@archives')
                    ->name('organizations.archives');
                $router->put('organizations/{organization}/duplicate', 'OrganizationsController@duplicate')
                    ->name('organizations.duplicate');
                $router->put('organizations/{organization}/suspend', 'OrganizationsController@suspend')
                    ->name('organizations.suspend');
                $router->resource('organizations', 'OrganizationsController');
            });
        });

        $api = app('Dingo\Api\Routing\Router');
        $api->version('v1', function($api) {
            $api->group([
                'middleware' => ['api.auth', 'bindings'],
            ], function($api) {
                $api->get('organizations', 'App\Http\Controllers\Api\OrganizationsController@index')
                    ->name('organizations.index');
            });
        });
    }
}
