<?php

namespace App\Providers\Modules;

use Gate;
use Illuminate\Support\ServiceProvider;

class TaxCodesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::policy('App\TaxCodePolicy', 'App\Policies\TaxCodePolicy');

        app('policy')->register('App\Http\Controllers\Admin\TaxCodesController', 'App\Policies\TaxCodePolicy');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        app('router')->group([
            'namespace'  => 'App\Http\Controllers',
            'middleware' => 'web',
        ], function ($router) {
            $router->group([
                'namespace' => 'Admin',
                'prefix'    => 'admin',
                'as'        => 'admin.',
            ], function ($router) {
                $router->resource('tax-codes', 'TaxCodesController');
            });
        });

        // API Routing
        app('router')->group([
            'namespace'  => 'App\Http\Controllers\Api',
            'prefix'     => 'api',
            'middleware' => 'api',
        ], function ($router) {
            $router->resource('users', 'TaxCodesController', [
                'only' => 'index',
            ]);
        });
    }
}
