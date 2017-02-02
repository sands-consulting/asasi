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
        // Module Routing
        app('router')->group([
            'namespace' => 'App\Http\Controllers',
            'middleware' => 'web'
        ], function ($router) {
            $router->group([
                'namespace' => 'Admin',
                'prefix' => 'admin',
                'as' => 'admin.'
            ], function ($router) {
                $router->put('packages/{package}/activate', [
                    'as'    => 'packages.activate',
                    'uses'  => 'PackagesController@activate'
                ]);
                $router->put('packages/{package}/deactivate', [
                    'as'    => 'packages.deactivate',
                    'uses'  => 'PackagesController@deactivate'
                ]);
                $router->get('packages/{package}/histories', [
                    'as'    => 'packages.histories',
                    'uses'  => 'PackagesController@histories'
                ]);
                $router->get('packages/{package}/revisions', [
                    'as'    => 'packages.revisions',
                    'uses'  => 'PackagesController@revisions'
                ]);
                $router->post('packages/{package}/duplicate', [
                    'as'    => 'packages.duplicate',
                    'uses'  => 'PackagesController@duplicate'
                ]);
                $router->resource('packages', 'PackagesController');
            });
        });
    }
}
