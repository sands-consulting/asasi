<?php

namespace App\Providers\Modules;

use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app('policy')->register('App\Htp\Controllers\CartController', 'App\Policies\CartPolicy');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Module Routing
        app('router')->group(['namespace' => 'App\Http\Controllers'], function ($router) {
            $router->get('cart', [
                'uses' => 'CartController@index',
                'as' => 'cart'
            ]);
            $router->post('cart', 'CartController@checkout');
            $router->delete('cart', ['CartController@destroy']);

            $router->put('cart/add', [
                'uses' => 'CartController@add',
                'as' => 'cart.add'
            ]);
            $router->delete('cart/remove', [
                'uses' => 'CartController@remove',
                'as' => 'cart.remove'
            ]);
        });
    }
}
