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
        app('router')->group([
            'namespace' => 'App\Http\Controllers',
            'middleware' => 'web'
        ], function ($router) {
            $router->group([
                'namespace' => 'Admin',
                'prefix' => 'admin',
                'as' => 'admin.'
            ], function ($router) {
                $router->resource('places', 'PlacesController');
                $router->get('places/{places}/revisions', 'PlacesController@revisions')
                    ->name('places.revisions');
            });
        });
    }
}
