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
        app('policy')->register('App\Http\Controllers\Admin\PlacesController', 'App\Policies\PlacePolicy');

        Gate::policy("App\Place", "App\Policies\PlacePolicy");
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
                $router->resource('places', 'PlacesController');
                $router->get('places/{places}/revisions', [
                    'as'    => 'admin.places.revisions',
                    'uses'  => 'PlacesController@revisions'
                ]);
                $router->put('places/{places}/activate', [
                    'as'    => 'admin.places.activate',
                    'uses'  => 'PlacesController@activate'
                ]);
                $router->put('places/{places}/deactivate', [
                    'as'    => 'admin.places.deactivate',
                    'uses'  => 'PlacesController@deactivate'
                ]);
            });
        });
    }
}
