<?php

namespace App\Providers\Modules;

use Illuminate\Support\ServiceProvider;

class VendorsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app('policy')->register('App\Http\Controllers\Admin\VendorsController', 'App\Policies\VendorsPolicy');
        app('policy')->register('App\Http\Controllers\VendorsController', 'App\Policies\VendorsPolicy');
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
                $router->put('vendors/{vendor}/approve', [
                    'as'    => 'vendors.approve',
                    'uses'  => 'VendorsController@approve'
                ]);
                $router->put('vendors/{vendor}/reject', [
                    'as'    => 'vendors.reject',
                    'uses'  => 'VendorsController@reject'
                ]);
                $router->put('vendors/{vendor}/activate', [
                    'as'    => 'vendors.activate',
                    'uses'  => 'VendorsController@activate'
                ]);
                $router->put('vendors/{vendor}/suspend', [
                    'as'    => 'vendors.suspend',
                    'uses'  => 'VendorsController@suspend'
                ]);
                $router->put('vendors/{vendor}/blacklist', [
                    'as'    => 'vendors.blacklist',
                    'uses'  => 'VendorsController@blacklist'
                ]);
                $router->put('vendors/{vendor}/unblacklist', [
                    'as'    => 'vendors.unblacklist',
                    'uses'  => 'VendorsController@unblacklist'
                ]);
                $router->get('vendors/{vendor}/revisions', [
                    'as'    => 'vendors.revisions',
                    'uses'  => 'VendorsController@revisions'
                ]);
                $router->get('vendors/{vendor}/histories', [
                    'as'    => 'vendors.histories',
                    'uses'  => 'VendorsController@histories'
                ]);

                $router->get('vendors/{vendor}/qualification-codes', [
                    'as'    => 'vendors.qualification-codes',
                    'uses'  => 'VendorsController@qualificationCodes'
                ]);

                $router->get('vendors/{vendor}/subscriptions', [
                    'as'    => 'vendors.subscriptions',
                    'uses'  => 'VendorsController@subscriptions'
                ]);

                $router->get('vendors/{vendor}/users', [
                    'as'    => 'vendors.users',
                    'uses'  => 'VendorsController@users'
                ]);

                $router->get('vendors/{vendor}/subscriptions', [
                    'as'    => 'vendors.subscriptions',
                    'uses'  => 'VendorsController@subscriptions'
                ]);

                $router->get('vendors/{vendor}/purchases', [
                    'as'    => 'vendors.purchases',
                    'uses'  => 'VendorsController@purchases'
                ]);
                
                $router->resource('vendors', 'VendorsController');
            });
            
            $router->get('vendors/{vendor}/qualification-codes', [
                'as'    => 'vendors.qualification-codes',
                'uses'  => 'VendorsController@qualificationCodes'
            ]);

            $router->get('vendors/{vendor}/purchases', [
                'as'    => 'vendors.purchases',
                'uses'  => 'VendorsController@purchases'
            ]);

            $router->get('vendors/{vendor}/transactions', [
                'as'    => 'vendors.transactions',
                'uses'  => 'VendorsController@transactions'
            ]);

            $router->get('vendors/{vendor}/eligibles', [
                'as' => 'vendors.eligibles',
                'uses' => 'VendorsController@eligibles'
            ]);

            $router->resource('vendors', 'VendorsController', [
                'except' => ['index', 'destroy']
            ]);
        });
    }
}
