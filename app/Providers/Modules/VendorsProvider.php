<?php

namespace App\Providers\Modules;

use App\Vendors;
use Illuminate\Support\ServiceProvider;

class VendorsProvider extends ServiceProvider
{
    public function boot()
    {
        # Register admin policy
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
            
            $router->get('vendors/{vendors}/pending', [
                'as'    => 'vendors.pending',
                'uses'  => 'VendorsController@pending'
            ]);

            $router->resource('vendors', 'VendorsController');
        });
    }
}
