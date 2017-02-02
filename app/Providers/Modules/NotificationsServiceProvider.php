<?php

namespace App\Providers\Modules;

use App\Notification;
use Illuminate\Support\ServiceProvider;

class NotificationsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
        // Module Routing
        app('router')->group(['namespace' => 'App\Http\Controllers'], function($router) {
            $router->resource('notifications', 'NotificationsController',
                ['only' => ['index', 'show']]);

            // Api Routing
            $router->group(['namespace' => 'Api', 'prefix' => 'api'], function ($router) {
                $router->get('notifications', [
                    'as' => 'api.notifications',
                    'uses' => 'NotificationsController@index'
                ]);
            });
        });
    }
}
