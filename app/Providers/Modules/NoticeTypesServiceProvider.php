<?php

namespace App\Providers\Modules;

use Illuminate\Support\ServiceProvider;

class NoticeTypesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app('policy')->register('App\Http\Controllers\Admin\NoticeTypesController', 'App\Policies\NoticeTypesPolicy');
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
            $router->model('notice_types', 'App\NoticeType');

            $router->group(['namespace' => 'Admin', 'prefix' => 'admin'], function ($router) {
                $router->put('notice-types/{notice_types}/activate', [
                    'as'    => 'admin.notice-types.activate',
                    'uses'  => 'NoticeTypesController@activate'
                ]);
                $router->put('notice-types/{notice_types}/deactivate', [
                    'as'    => 'admin.notice-types.deactivate',
                    'uses'  => 'NoticeTypesController@deactivate'
                ]);
                $router->get('notice-types/{notice_types}/logs', [
                    'as'    => 'admin.notice-types.logs',
                    'uses'  => 'NoticeTypesController@logs'
                ]);
                $router->get('notice-types/{notice_types}/revisions', [
                    'as'    => 'admin.notice-types.revisions',
                    'uses'  => 'NoticeTypesController@revisions'
                ]);
                $router->post('notice-types/{notice_types}/duplicate', [
                    'as'    => 'admin.notice-types.duplicate',
                    'uses'  => 'NoticeTypesController@duplicate'
                ]);
                $router->resource('notice-types', 'NoticeTypesController');
            });
        });
    }
}
