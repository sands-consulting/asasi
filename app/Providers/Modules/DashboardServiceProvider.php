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
                $router->get('dashboard/user', [
                    'as'    => 'admin.dashboard.user',
                    'uses'  => 'DashboardController@user'
                ]);
                $router->get('dashboard/vendor', [
                    'as'    => 'admin.dashboard.vendor',
                    'uses'  => 'DashboardController@vendor'
                ]);
                $router->get('dashboard/transaction', [
                    'as'    => 'admin.dashboard.transaction',
                    'uses'  => 'DashboardController@transaction'
                ]);
                $router->get('dashboard/portfolio', [
                    'as'    => 'admin.dashboard.portfolio',
                    'uses'  => 'DashboardController@portfolio'
                ]);
                $router->get('dashboard/tender', [
                    'as'    => 'admin.dashboard.tender',
                    'uses'  => 'DashboardController@tender'
                ]);
                $router->resource('dashboard', 'DashboardController');
            });

            $router->get('dashboard/eligible', [
                'as'    => 'dashboard.eligible',
                'uses'  => 'DashboardController@eligible'
            ]);

            $router->get('dashboard/purchased', [
                'as'    => 'dashboard.purchased',
                'uses'  => 'DashboardController@purchased'
            ]);

            $router->get('dashboard/limited', [
                'as'    => 'dashboard.limited',
                'uses'  => 'DashboardController@limited'
            ]);

            $router->resource('dashboard', 'DashboardController');
        });
    }
}
