<?php

namespace App\Providers\Modules;

use App\VendorType;
use Illuminate\Support\ServiceProvider;

class VendorTypesProvider extends ServiceProvider
{
    public function boot()
    {
        # Register admin policy
        // app('policy')->register('App\Http\Controllers\VendorTypesController', 'App\Policies\VendorTypesPolicy');
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
            $router->model('vendor_types', 'App\VendorType');

            $router->group(['namespace' => 'Admin', 'prefix' => 'admin'], function ($router) {
                $router->resource('vendor-types', 'VendorTypesController');
            });
            
            $router->get('vendor-types/{vendor_types}/pending', [
                'as'    => 'vendor-types.pending',
                'uses'  => 'VendorTypesController@pending'
            ]);

            $router->resource('vendor-types', 'VendorTypesController');
        });
    }
}
