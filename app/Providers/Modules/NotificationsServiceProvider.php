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
        app('router')->group(['namespace' => 'App\Http\Controllers'], function($router) {
            $router->bind('notifications', function($id) {    
                return Notification::withTrashed()->find($id);
            });

            $router->resource('notifications', 'NotificationsController', ['only' => ['index', 'show']]);

            /* Api */
            $router->group(['namespace' => 'Api', 'prefix' => 'api'], function ($router) {
                $router->get('notifications', [
                    'as' => 'api.notifications',
                    'uses' => 'NotificationsController@index'
                ]);
            });
        });
    }
}
