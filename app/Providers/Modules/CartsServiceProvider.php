<?php

namespace App\Providers\Modules;

use Illuminate\Support\ServiceProvider;

class CartsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // app('policy')->register('App\Http\Controllers\CartsController', 'App\Policies\CartsPolicy');
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
            // $router->model('items', 'App\Notice');
            $router->post('carts/{notices}/add', [
                'uses' => 'CartsController@add',
                'as' => 'carts.add'
            ]);

            $router->post('carts/{carts}/remove', [
                'uses' => 'CartsController@remove',
                'as' => 'carts.remove'
            ]);

            $router->resource('carts', 'CartsController');
        });
    }
}
