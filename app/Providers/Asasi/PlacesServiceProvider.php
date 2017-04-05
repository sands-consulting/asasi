<?php

namespace App\Providers\Asasi;

use App\Place;
use Gate;
use Illuminate\Support\ServiceProvider;

class PlacesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::policy('App\Place', 'App\Policies\Asasi\PlacePolicy');

        app('policy')->register('App\Http\Controllers\Admin\PlacesController', 'App\Policies\PlacePolicy');
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
                $router->put('places/{place}/restore', 'PlacesController@restore')
                    ->name('places.restore');
                $router->get('places/{place}/revisions', 'PlacesController@revisions')
                    ->name('places.revisions');
                $router->get('places/{place}/histories', 'PlacesController@histories')
                    ->name('places.histories');
                $router->get('places/archives', 'PlacesController@archives')
                    ->name('places.archives');
                $router->put('places/{place}/duplicate', 'PlacesController@duplicate')
                    ->name('places.duplicate');
                $router->resource('places', 'PlacesController');
            });
        });
    }
}
