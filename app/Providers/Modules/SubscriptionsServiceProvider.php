<?php

namespace App\Providers\Modules;

use Illuminate\Support\ServiceProvider;

class SubscriptionsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app('policy')->register('App\Http\Controllers\SubscriptionsController', 'App\Policies\SubscriptionsPolicy');
        app('policy')->register('App\Http\Controllers\Admin\SubscriptionsController', 'App\Policies\SubscriptionsPolicy');
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
                $router->put('subscriptions/{subscriptions}/activate', [
                    'as'  => 'subscriptions.activate',
                    'uses' => 'SubscriptionsController@activate'
                ]);
                $router->put('subscriptions/{subscriptions}/deactivate', [
                    'as'  => 'subscriptions.deactivate',
                    'uses' => 'SubscriptionsController@deactivate'
                ]);
                $router->put('subscriptions/{subscriptions}/cancel', [
                    'as'  => 'subscriptions.cancel',
                    'uses' => 'SubscriptionsController@cancel'
                ]);
                $router->resource('subscriptions', 'SubscriptionsController');
            });

            $router->resource('vendors.subscriptions', 'VendorSubscriptionsController',
                ['only' => ['index', 'show', 'create', 'store']]);
        });
    }
}
