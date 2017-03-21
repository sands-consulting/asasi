<?php

namespace App\Providers\Asasi;

use Gate;
use Illuminate\Support\ServiceProvider;

class SubscriptionsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::policy('App\Package', 'App\Policies\Asasi\PackagePolicy');
        Gate::policy('App\Subscription', 'App\Policies\Asasi\SubscriptionPolicy');

        app('policy')->register('App\Http\Controllers\SubscriptionsController', 'App\Policies\SubscriptionPolicy');
        app('policy')->register('App\Http\Controllers\Admin\PackagesController', 'App\Policies\PackagePolicy');
        app('policy')->register('App\Http\Controllers\Admin\SubscriptionsController', 'App\Policies\SubscriptionPolicy');
    }

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
                $router->put('subscriptions/{subscription}/restore', 'SubscriptionsController@restore')
                    ->name('subscriptions.restore');
                $router->get('subscriptions/{subscription}/revisions', 'SubscriptionsController@revisions')
                    ->name('subscriptions.revisions');
                $router->get('subscriptions/{subscription}/histories', 'SubscriptionsController@histories')
                    ->name('subscriptions.histories');
                $router->get('subscriptions/archives', 'SubscriptionsController@archives')
                    ->name('subscriptions.archives');
                $router->put('subscriptions/{subscription}/duplicate', 'SubscriptionsController@duplicate')
                    ->name('subscriptions.duplicate');

                $router->put('subscriptions/{subscription}/activate', 'SubscriptionsController@activate')
                    ->name('subscriptions.activate');
                $router->put('subscriptions/{subscription}/cancel', 'SubscriptionsController@cancel')
                    ->name('subscriptions.cancel');

                $router->resource('subscriptions', 'SubscriptionsController');

                // Package
                $router->put('packages/{package}/restore', 'PackagesController@restore')
                    ->name('packages.restore');
                $router->get('packages/{package}/revisions', 'PackagesController@revisions')
                    ->name('packages.revisions');
                $router->get('packages/{package}/histories', 'PackagesController@histories')
                    ->name('packages.histories');
                $router->get('packages/archives', 'PackagesController@archives')
                    ->name('packages.archives');
                $router->put('packages/{package}/duplicate', 'PackagesController@duplicate')
                    ->name('packages.duplicate');
                $router->resource('packages', 'PackagesController');
            });

            $router->resource('subscriptions', 'SubscriptionsController',
                ['only' => ['index', 'show', 'create', 'store']]);
        });
    }
}
