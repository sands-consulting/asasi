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
                
                $router->resource('vendors', 'VendorsController');
            });
            
            $router->post('vendors/{vendors}/complete-application', [
                'as'    => 'vendors.complete-application',
                'uses'  => 'VendorsController@completeApplication'
            ]);

            $router->post('vendors/{vendors}/cancel-submit', [
                'as'    => 'vendors.cancel-application',
                'uses'  => 'VendorsController@cancelApplication'
            ]);

            $router->get('vendors/{vendors}/pending', [
                'as'    => 'vendors.pending',
                'uses'  => 'VendorsController@pending'
            ]);
            
            $router->get('vendors/profile', [
                'as'    => 'vendors.profile',
                'uses'  => 'VendorsController@profile'
            ]);

            $router->resource('vendors', 'VendorsController');
        });
    }
}
