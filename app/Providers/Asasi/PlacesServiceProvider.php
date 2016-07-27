<?php

namespace App\Providers\Asasi;

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
        app('policy')->register('App\Http\Controllers\Admin\PlacesController', 'App\Policies\PlacesPolicy');
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
            $router->model('places', 'App\Place');

            $router->group(['namespace' => 'Admin', 'prefix' => 'admin'], function ($router) {
                $router->get('places/{places}/revisions', [
                    'as'    => 'admin.places.revisions',
                    'uses'  => 'PlacesController@revisions'
                ]);
                $router->resource('places',  'PlacesController');
            });
        });
    }
}
