<?php

namespace App\Providers\Modules;

use Gate;
use Illuminate\Support\ServiceProvider;

class SubscriptionsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::policy('App\Subscription', 'App\Policies\SubscriptionPolicy');

        app('policy')->register('App\Http\Controllers\VendorSubscriptionsController', 'App\Policies\SubscriptionPolicy');
        app('policy')->register('App\Http\Controllers\Admin\SubscriptionsController', 'App\Policies\SubscriptionPolicy');
    }

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
                $router->put('subscriptions/{subscription}/restore', 'subscriptionsController@restore')
                    ->name('subscriptions.restore');
                $router->get('subscriptions/{subscription}/revisions', 'subscriptionsController@revisions')
                    ->name('subscriptions.revisions');
                $router->get('subscriptions/{subscription}/histories', 'subscriptionsController@histories')
                    ->name('subscriptions.histories');
                $router->get('subscriptions/archives', 'subscriptionsController@archives')
                    ->name('subscriptions.archives');
                $router->put('subscriptions/{subscription}/duplicate', 'subscriptionsController@duplicate')
                    ->name('subscriptions.duplicate');

                $router->put('subscriptions/{subscription}/activate', [
                    'as'  => 'subscriptions.activate',
                    'uses' => 'SubscriptionsController@activate'
                ]);
                $router->put('subscriptions/{subscription}/cancel', [
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
