<?php

namespace App\Providers\Modules;

use Illuminate\Support\ServiceProvider;

class DashboardServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        app('policy')->register('App\Http\Controllers\Admin\DashboardController', 'App\Policies\DashboardPolicy');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        // module routing
        app('router')->group(['namespace' => 'App\Http\Controllers'], function ($router) {
            // $router->model('users', 'App\User');

            $router->group(['namespace' => 'Admin', 'prefix' => 'admin'], function ($router) { 
                $router->resource('dashboard', 'DashboardController');
            });
            $router->resource('dashboard', 'DashboardController');
        });
    }
}
