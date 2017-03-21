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

        app('policy')->register('App\Http\Controllers\Admin\OrganizationsController', 'App\Policies\OrganizationPolicy');
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
                    ->name('organization.restore');
                $router->get('organizations/{organization}/revisions', 'OrganizationsController@revisions')
                    ->name('organization.revisions');
                $router->get('organizations/{organization}/histories', 'OrganizationsController@histories')
                    ->name('organization.histories');
                $router->get('organizations/archives', 'OrganizationsController@archives')
                    ->name('organization.archives');
                $router->put('organizations/{organization}/duplicate', 'OrganizationsController@duplicate')
                    ->name('organization.duplicate');
                $router->resource('organizations', 'OrganizationsController');
            });
        });
    }
}
