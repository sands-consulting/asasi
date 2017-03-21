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
        Gate::policy('App\Organization', 'App\Policies\OrganizationPolicy');

        app('policy')->register('App\Http\Controllers\Admin\OrganizationsController', 'App\Policies\OrganizationPolicy');
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
                $router->resource('organizations', 'OrganizationsController');
                $router->get('organizations/{organization}/histories', 'OrganizationsController@histories')
                    ->name('organizations.histories');
                $router->get('organizations/{organization}/revisions', 'OrganizationsController@revisions')
                    ->name('organizations.revisions');
                $router->put('organizations/{organization}/deactivate', 'OrganizationsController@deactivate')
                    ->name('organizations.deactivate');
                $router->put('organizations/{organization}/suspend', 'OrganizationsController@suspend')
                    ->name('organizations.suspend');
                $router->get('organizations/archives', 'OrganizationsController@archives')
                    ->name('organizations.archives');
            });
        });
    }
}
