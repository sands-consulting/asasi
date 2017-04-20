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

        $api = app('Dingo\Api\Routing\Router');
        $api->version('v1', function($api) {
            $api->group([
                'middleware' => ['api.auth', 'bindings'],
            ], function($api) {
                $api->get('notifications', 'App\Http\Controllers\Api\NotificationsController@index')
                ->name('api.notifications.index');
                $api->put('notifications/{notification}/read', 'App\Http\Controllers\Api\NotificationsController@read')
                ->name('api.notifications.read');
            });
        });
    }
}
