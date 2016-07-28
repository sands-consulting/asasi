<?php

namespace App\Providers\Modules;

use App\Vendors;
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
            
            $router->resource('vendors', 'VendorsController');
        });
    }
}
