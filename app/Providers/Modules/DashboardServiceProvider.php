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
        // Module Routing
        app('router')->group([
            'namespace' => 'App\Http\Controllers',
            'middleware' => 'web'
        ], function ($router) {
            $router->group([
                'namespace' => 'Admin',
                'prefix' => 'admin',
            ], function ($router) {
                $router->group([
                    'as' => 'admin.'
                ], function($router) {
                    $router->get('dashboard/user', [
                        'as'    => 'dashboard.user',
                        'uses'  => 'DashboardController@user'
                    ]);
                    $router->get('dashboard/vendor', [
                        'as'    => 'dashboard.vendor',
                        'uses'  => 'DashboardController@vendor'
                    ]);
                    $router->get('dashboard/transaction', [
                        'as'    => 'dashboard.transaction',
                        'uses'  => 'DashboardController@transaction'
                    ]);
                    $router->get('dashboard/portfolio', [
                        'as'    => 'dashboard.portfolio',
                        'uses'  => 'DashboardController@portfolio'
                    ]);
                    $router->get('dashboard/tender', [
                        'as'    => 'dashboard.tender',
                        'uses'  => 'DashboardController@tender'
                    ]);
                });
                $router->get('/', [
                    'as'    => 'admin',
                    'uses'  => 'DashboardController@index'
                ]);
            });

        });

        // API Routing
        app('router')->group([
            'namespace' => 'App\Http\Controllers\Api',
            'prefix' => 'api',
            'middleware' => 'api'
        ], function ($router) {
            $router->get('dashboard/chart-login-activity', [
                'as' => 'api.dashboard.chart-login-activity',
                'uses' => 'DashboardController@chartLoginActivity'
            ]);
        });
    }
}
