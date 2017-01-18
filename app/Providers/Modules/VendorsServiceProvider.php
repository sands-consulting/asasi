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
        # Register admin routing
        app('router')->group(['namespace' => 'App\Http\Controllers'], function($router) {
            $router->model('vendors', 'App\Vendor');

            $router->group(['namespace' => 'Admin', 'prefix' => 'admin'], function ($router) {
                $router->put('vendors/{vendors}/approve', [
                    'as'    => 'admin.vendors.approve',
                    'uses'  => 'VendorsController@approve'
                ]);
                $router->put('vendors/{vendors}/reject', [
                    'as'    => 'admin.vendors.reject',
                    'uses'  => 'VendorsController@reject'
                ]);
                $router->put('vendors/{vendors}/activate', [
                    'as'    => 'admin.vendors.activate',
                    'uses'  => 'VendorsController@activate'
                ]);
                $router->put('vendors/{vendors}/suspend', [
                    'as'    => 'admin.vendors.suspend',
                    'uses'  => 'VendorsController@suspend'
                ]);
                $router->put('vendors/{vendors}/blacklist', [
                    'as'    => 'admin.vendors.blacklist',
                    'uses'  => 'VendorsController@blacklist'
                ]);
                $router->put('vendors/{vendors}/unblacklist', [
                    'as'    => 'admin.vendors.unblacklist',
                    'uses'  => 'VendorsController@unblacklist'
                ]);
                $router->get('vendors/{vendors}/revisions', [
                    'as'    => 'admin.vendors.revisions',
                    'uses'  => 'VendorsController@revisions'
                ]);
                $router->get('vendors/{vendors}/logs', [
                    'as'    => 'admin.vendors.logs',
                    'uses'  => 'VendorsController@logs'
                ]);

                $router->get('vendors/{vendors}/qualification-codes', [
                    'as'    => 'admin.vendors.qualification-codes',
                    'uses'  => 'VendorsController@qualificationCodes'
                ]);

                $router->get('vendors/{vendors}/subscriptions', [
                    'as'    => 'admin.vendors.subscriptions',
                    'uses'  => 'VendorsController@subscriptions'
                ]);

                $router->get('vendors/{vendors}/users', [
                    'as'    => 'admin.vendors.users',
                    'uses'  => 'VendorsController@users'
                ]);

                $router->get('vendors/{vendors}/subscriptions', [
                    'as'    => 'admin.vendors.subscriptions',
                    'uses'  => 'VendorsController@subscriptions'
                ]);

                $router->get('vendors/{vendors}/purchases', [
                    'as'    => 'admin.vendors.purchases',
                    'uses'  => 'VendorsController@purchases'
                ]);
                
                $router->resource('vendors', 'VendorsController');
            });
            
            $router->get('vendors/{vendors}/qualification-codes', [
                'as'    => 'vendors.qualification-codes',
                'uses'  => 'VendorsController@qualificationCodes'
            ]);

            $router->get('vendors/{vendors}/users', [
                'as'    => 'vendors.users',
                'uses'  => 'VendorsController@users'
            ]);

            $router->get('vendors/{vendors}/subscriptions', [
                'as'    => 'vendors.subscriptions',
                'uses'  => 'VendorsController@subscriptions'
            ]);

            $router->get('vendors/{vendors}/purchases', [
                'as'    => 'vendors.purchases',
                'uses'  => 'VendorsController@purchases'
            ]);

            $router->get('vendors/{vendors}/transactions', [
                'as'    => 'vendors.transactions',
                'uses'  => 'VendorsController@transactions'
            ]);

            $router->resource('vendors', 'VendorsController', [
                'except' => ['index', 'destroy']
            ]);
        });
    }
}
