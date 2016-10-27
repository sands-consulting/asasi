<?php

namespace App\Providers\Modules;

use App\News;
use Illuminate\Support\ServiceProvider;

class NotificationsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // app('policy')
            // ->register('App\Http\Controllers\Admin\AllocationsController', 'App\Policies\AllocationsPolicy');
    }

    public function register()
    {
        app('router')->group(['namespace' => 'App\Http\Controllers'], function ($router) {
            $router->resource('notifications', 'NotificationsController');
        });

        app('router')->group(['namespace' => 'App\Http\Controllers\Api', 'prefix' => 'api'], function ($router) {
            $router->get('notifications', [
                'as' => 'api.notifications',
                'uses' => 'NotificationsController@index'
            ]);
        });
    }
}
