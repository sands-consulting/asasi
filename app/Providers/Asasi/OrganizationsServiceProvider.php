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
                $router->get('organizations/{organization}/histories', 'OrganizationsController@histories')
                    ->name('organizations.histories');
                $router->get('organizations/{organization}/revisions', 'OrganizationsController@revisions')
                    ->name('organizations.revisions');
                $router->get('organizations/archives', 'OrganizationsController@archives')
                    ->name('organizations.archives');
                $router->resource('organizations', 'OrganizationsController');
            });
        });
    }
}
