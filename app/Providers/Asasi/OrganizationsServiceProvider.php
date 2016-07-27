<?php

namespace App\Providers\Asasi;

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
        app('policy')->register('App\Http\Controllers\Admin\OrganizationsController', 'App\Policies\OrganizationsPolicy');
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
            $router->model('organizations', 'App\Organization');

            $router->group(['namespace' => 'Admin', 'prefix' => 'admin'], function ($router) {
                $router->get('organizations/{organizations}/revisions', [
                    'as'    => 'admin.organizations.revisions',
                    'uses'  => 'OrganizationsController@revisions'
                ]);
                $router->put('organizations/{organizations}/activate', [
                    'as'    => 'admin.organizations.activate',
                    'uses'  => 'OrganizationsController@activate',
                ]);
                $router->put('organizations/{organizations}/deactivate', [
                    'as'    => 'admin.organizations.deactivate',
                    'uses'  => 'OrganizationsController@deactivate',
                ]);
                $router->put('organizations/{organizations}/suspend', [
                    'as'    => 'admin.organizations.suspend',
                    'uses'  => 'OrganizationsController@suspend',
                ]);
                $router->resource('organizations', 'OrganizationsController');
            });
        });
    }
}
