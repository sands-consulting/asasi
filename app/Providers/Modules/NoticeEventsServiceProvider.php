<?php

namespace App\Providers\Modules;

use Illuminate\Support\ServiceProvider;

class NoticeEventsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app('policy')->register('App\Http\Controllers\Admin\NoticeEventsController', 'App\Policies\NoticeEventsPolicy');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // API Routing
        app('router')->group([
            'namespace' => 'App\Http\Controllers\Api',
            'prefix' => 'api',
            'middleware' => 'api'
        ], function ($router) {
            $router->post('notice-events/{notice}/store', [
                'as' => 'api.notice-events.store',
                'uses' => 'NoticeEventsController@store'
            ]);
            $router->post('notice-events/update', [
                'as' => 'api.notice-events.update',
                'uses' => 'NoticeEventsController@update'
            ]);
            $router->post('notice-events/delete/{notice_event}', [
                'as' => 'api.notice-events.delete',
                'uses' => 'NoticeEventsController@delete'
            ]);
        });
    }
}
