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
        app('policy')->register('App\Http\Controllers\Admin\OrganizationsController', 'App\Policies\OrganizationPolicy');

        Gate::policy("App\Organization", "App\Policies\OrganizationPolicy");
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        // module routing
        app('router')->group(['namespace' => 'App\Http\Controllers'], function ($router) {
            $router->group(['namespace' => 'Admin', 'prefix' => 'admin'], function ($router) {
                $router->resource('organizations', 'OrganizationsController');
                $router->get('organizations/{organization}/revisions', [
                    'as'    => 'admin.organizations.revisions',
                    'uses'  => 'OrganizationsController@revisions'
                ]);
                $router->put('organizations/{organization}/activate', [
                    'as'    => 'admin.organizations.activate',
                    'uses'  => 'OrganizationsController@activate',
                ]);
                $router->put('organizations/{organization}/deactivate', [
                    'as'    => 'admin.organizations.deactivate',
                    'uses'  => 'OrganizationsController@deactivate',
                ]);
                $router->put('organizations/{organization}/suspend', [
                    'as'    => 'admin.organizations.suspend',
                    'uses'  => 'OrganizationsController@suspend',
                ]);
            });
        });
    }
}
