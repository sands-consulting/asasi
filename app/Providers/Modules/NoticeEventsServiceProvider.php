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
        // api routing
        app('router')->group(['namespace' => 'App\Http\Controllers\Api', 'prefix' => 'api'], function ($router) {
            $router->model('notice_events', 'App\NoticeEvent');

            $router->post('notice-events/store', [
                'as' => 'api.notice-events.store',
                'uses' => 'NoticeEventsController@store'
            ]);
            $router->post('notice-events/update', [
                'as' => 'api.notice-events.update',
                'uses' => 'NoticeEventsController@update'
            ]);
            $router->post('notice-events/delete/{notice_events}', [
                'as' => 'api.notice-events.delete',
                'uses' => 'NoticeEventsController@delete'
            ]);
        });
    }
}
