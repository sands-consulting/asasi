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
                $router->put('vendor-types/{vendor_type}/activate', [
                    'as'    => 'vendor-types.activate',
                    'uses'  => 'VendorTypesController@activate'
                ]);
                $router->put('vendor-types/{vendor_type}/deactivate', [
                    'as'    => 'vendor-types.deactivate',
                    'uses'  => 'VendorTypesController@deactivate'
                ]);
                $router->get('vendor-types/{vendor_type}/revisions', [
                    'as'    => 'vendor-types.revisions',
                    'uses'  => 'VendorTypesController@revisions'
                ]);
                $router->post('vendor-types/{vendor_type}/duplicate', [
                    'as'    => 'vendor-types.duplicate',
                    'uses'  => 'VendorTypesController@duplicate'
                ]);
                $router->resource('vendor-types', 'VendorTypesController');
            });
        });
    }
}
