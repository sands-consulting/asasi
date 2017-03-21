<?php

namespace App\Providers\Asasi;

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
        app('router')->group([
            'namespace' => 'App\Http\Controllers',
            'middleware' => 'web'
        ], function ($router) {
            $router->resource('notifications', 'NotificationsController',
                ['only' => ['index', 'show']]);
        });

        // API Routing
        app('router')->group([
            'namespace' => 'App\Http\Controllers\Api',
            'middleware' => 'web',
            'prefix' => 'api'
        ], function ($router) {
            $router->get('notifications', [
                'as' => 'api.notifications',
                'uses' => 'NotificationsController@index'
            ]);
        });
    }
}
