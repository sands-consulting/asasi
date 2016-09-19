<?php

namespace App\Providers\Modules;

use Illuminate\Support\ServiceProvider;

class SubscriptionsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app('policy')->register('App\Http\Controllers\SubscriptionsController', 'App\Policies\SubscriptionsPolicy');
    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        # Register admin routing
        app('router')->group(['namespace' => 'App\Http\Controllers'], function($router) {
            $router->model('subscriptions', 'App\Subscription');

            $router->group(['namespace' => 'Admin', 'prefix' => 'admin'], function ($router) {
                $router->resource('subscriptions', 'SubscriptionsController');
            });
            
            $router->get('subscriptions/current', [
                'as'  => 'subscriptions.current',
                'uses' => 'SubscriptionsController@current'
            ]);

            $router->get('subscriptions/history', [
                'as'  => 'subscriptions.history',
                'uses' => 'SubscriptionsController@history'
            ]);

            $router->post('subscriptions/{packages}/payment', [
                'as'  => 'subscriptions.payment',
                'uses' => 'SubscriptionsController@payment'
            ]);

            $router->post('subscriptions/{packages}/endpoint', [
                'as'  => 'subscriptions.endpoint',
                'uses' => 'SubscriptionsController@endpoint'
            ]);

            $router->get('subscriptions/redirect', [
                'as'  => 'subscriptions.redirect-uri',
                'uses' => 'SubscriptionsController@redirectUri'
            ]);

            $router->resource('subscriptions', 'SubscriptionsController');
        });
    }
}
