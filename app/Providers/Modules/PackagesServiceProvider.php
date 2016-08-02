<?php

namespace App\Providers\Modules;

use Illuminate\Support\ServiceProvider;

class PackagesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app('policy')->register('App\Http\Controllers\Admin\PackagesController', 'App\Policies\PackagesPolicy');
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
            $router->model('packages', 'App\Package');

            $router->group(['namespace' => 'Admin', 'prefix' => 'admin'], function ($router) {
                $router->put('packages/{packages}/activate', [
                    'as'    => 'admin.packages.activate',
                    'uses'  => 'PackagesController@activate'
                ]);
                $router->put('packages/{packages}/deactivate', [
                    'as'    => 'admin.packages.deactivate',
                    'uses'  => 'PackagesController@deactivate'
                ]);
                $router->get('packages/{packages}/logs', [
                    'as'    => 'admin.packages.logs',
                    'uses'  => 'PackagesController@logs'
                ]);
                $router->get('packages/{packages}/revisions', [
                    'as'    => 'admin.packages.revisions',
                    'uses'  => 'PackagesController@revisions'
                ]);
                $router->post('packages/{packages}/duplicate', [
                    'as'    => 'admin.packages.duplicate',
                    'uses'  => 'PackagesController@duplicate'
                ]);
                $router->resource('packages', 'PackagesController');
            });
        });
    }
}
