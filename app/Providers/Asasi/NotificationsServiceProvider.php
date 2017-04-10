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
            $router->resource('notifications', 'NotificationsController', ['only' => ['index', 'show']]);
        });

        // API Routing
        app('router')->group([
            'namespace' => 'App\Http\Controllers\Api',
            'middleware' => 'web',
            'prefix' => 'api',
            'as' => 'api.',
        ], function ($router) {
            $router->get('notifications', 'NotificationsController@index')
                ->name('notifications.index');
            $router->put('notifications/read', 'NotificationsController@read')
                ->name('notifications.read');
        });
    }
}
