<?php

namespace App\Providers\Modules;

use App\Vendor;
use App\VendorType;
use Gate;
use Illuminate\Support\ServiceProvider;

class VendorsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::policy('App\Vendor', 'App\Policies\VendorPolicy');
        Gate::policy('App\VendorType', 'App\Policies\VendorTypePolicy');

        app('policy')->register('App\Http\Controllers\Admin\VendorsController', 'App\Policies\VendorPolicy');
        app('policy')->register('App\Http\Controllers\VendorsController', 'App\Policies\VendorPolicy');
        app('policy')->register('App\Http\Controllers\Admin\VendorTypesController', 'App\Policies\VendorTypePolicy');
    }

    public function register()
    {
        app('router')->group([
            'namespace'  => 'App\Http\Controllers',
            'middleware' => 'web'
        ], function ($router) {
            $router->group([
                'namespace' => 'Admin',
                'prefix'    => 'admin',
                'as'        => 'admin.',
            ], function ($router) {
                $router->model('vendor', Vendor::class);
                $router->put('vendors/{subscription}/restore', 'VendorsController@restore')
                    ->name('vendors.restore');
                $router->get('vendors/{vendor}/revisions', 'VendorsController@revisions')
                    ->name('vendors.revisions');
                $router->get('vendors/{vendor}/histories', 'VendorsController@histories')
                    ->name('vendors.histories');
                $router->get('vendors/archives', 'VendorsController@archives')
                    ->name('vendors.archives');
                $router->put('vendors/{vendor}/duplicate', 'VendorsController@duplicate')
                    ->name('vendors.duplicate');

                $router->put('vendors/{vendor}/approve', 'VendorsController@approve')
                    ->name('vendors.approve');
                $router->put('vendors/{vendor}/reject', 'VendorsController@reject')
                    ->name('vendors.reject');
                $router->put('vendors/{vendor}/activate', 'VendorsController@activate')
                    ->name('vendors.activate');
                $router->put('vendors/{vendor}/suspend', 'VendorsController@suspend')
                    ->name('vendors.suspend');

                $router->resource('vendors', 'VendorsController');

                // Vendor Type
                $router->model('vendor_type', VendorType::class);
                $router->put('vendor-types{vendor_type}/restore', 'VendorTypesController@restore')
                    ->name('vendor-types.restore');
                $router->get('vendor-types{vendor_type}/revisions', 'VendorTypesController@revisions')
                    ->name('vendor-types.revisions');
                $router->get('vendor-types{vendor_type}/histories', 'VendorTypesController@histories')
                    ->name('vendor-types.histories');
                $router->get('vendor-typesarchives', 'VendorTypesController@archives')
                    ->name('vendor-types.archives');
                $router->put('vendor-types{vendor_type}/duplicate', 'VendorTypesController@duplicate')
                    ->name('vendor-types.duplicate');
                $router->resource('vendor-types', 'VendorTypesController');
            });

            $router->get('vendors/{vendor}/pending', 'VendorsController@pending')
                ->name('vendors.pending');

            $router->get('vendors/{vendor}/eligibles', 'VendorsController@eligibles')
                ->name('vendors.eligibles');
            $router->get('vendors/{vendor}/invitations', 'VendorsController@invitations')
                ->name('vendors.invitations');
            $router->get('vendors/{vendor}/purchases', 'VendorsController@purchases')
                ->name('vendors.purchases');

            $router->resource('vendors', 'VendorsController', [
                'except' => ['index', 'destroy']]);
        });

        $api = app('Dingo\Api\Routing\Router');
        $api->version('v1', function($api) {
            $api->group([
                'middleware' => ['api.auth', 'bindings'],
            ], function($api) {
                $api->get('vendors', 'App\Http\Controllers\Api\VendorsController@index')
                    ->name('vendors.index');
            });
        });
    }
}
