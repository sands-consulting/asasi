<?php

namespace App\Providers\Modules;

use Illuminate\Support\ServiceProvider;

class NoticePurchasesServiceProvider extends ServiceProvider
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
         app('router')->group([
            'namespace' => 'App\Http\Controllers',
            'middleware' => 'web'
        ], function ($router) {
            $router->get('cart', [
                'uses' => 'CartController@index',
                'as' => 'cart'
            ]);
            $router->post('cart', 'CartController@checkout');
            $router->delete('cart', 'CartController@destroy');

            $router->put('cart/add/{notice}', [
                'uses' => 'CartController@add',
                'as' => 'cart.add'
            ]);
            $router->delete('cart/remove/{id}', [
                'uses' => 'CartController@remove',
                'as' => 'cart.remove'
            ]);
        });
    }
}
