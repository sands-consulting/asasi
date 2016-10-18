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
                $router->get('/', [
                    'as'    => 'admin',
                    'uses'  => 'DashboardController@index'
                ]);
            });

            $router->get('dashboard/eligibles', [
                'as'    => 'dashboard.eligibles',
                'uses'  => 'DashboardController@eligibles'
            ]);
            $router->get('dashboard/invitations', [
                'as'    => 'dashboard.invitations',
                'uses'  => 'DashboardController@invitations'
            ]);
            $router->get('dashboard/bookmarks', [
                'as'    => 'dashboard.bookmarks',
                'uses'  => 'DashboardController@bookmarks'
            ]);
            $router->get('dashboard/purchases', [
                'as'    => 'dashboard.purchases',
                'uses'  => 'DashboardController@purchases'
            ]);
            $router->get('dashboard/projects', [
                'as'    => 'dashboard.projects',
                'uses'  => 'DashboardController@projects'
            ]);
        });

        // api routing
        app('router')->group(['namespace' => 'App\Http\Controllers\Api', 'prefix' => 'api'], function ($router) {
            $router->get('dashboard/chart-login-activity', [
                'as' => 'api.dashboard.chart-login-activity',
                'uses' => 'DashboardController@chartLoginActivity'
            ]);
        });
    }
}
