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
                $router->put('vendor-types/{vendor_types}/activate', [
                    'as'    => 'admin.vendor-types.activate',
                    'uses'  => 'VendorTypesController@activate'
                ]);
                $router->put('vendor-types/{vendor_types}/deactivate', [
                    'as'    => 'admin.vendor-types.deactivate',
                    'uses'  => 'VendorTypesController@deactivate'
                ]);
                $router->get('vendor-types/{vendor_types}/revisions', [
                    'as'    => 'admin.vendor-types.revisions',
                    'uses'  => 'VendorTypesController@revisions'
                ]);
                $router->post('vendor-types/{vendor_types}/duplicate', [
                    'as'    => 'admin.vendor-types.duplicate',
                    'uses'  => 'VendorTypesController@duplicate'
                ]);
                $router->resource('vendor-types', 'VendorTypesController');
            });
        });
    }
}
