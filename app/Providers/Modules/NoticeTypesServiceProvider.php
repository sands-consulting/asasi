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
        // Module Routing
        app('router')->group([
            'namespace' => 'App\Http\Controllers',
            'middleware' => 'web'
        ], function ($router) {
            $router->group([
                'namespace' => 'Admin',
                'prefix' => 'admin',
                'as' => 'admin.'
            ], function ($router) {
                $router->put('notice-types/{notice_type}/activate', [
                    'as'    => 'notice-types.activate',
                    'uses'  => 'NoticeTypesController@activate'
                ]);
                $router->put('notice-types/{notice_type}/deactivate', [
                    'as'    => 'notice-types.deactivate',
                    'uses'  => 'NoticeTypesController@deactivate'
                ]);
                $router->get('notice-types/{notice_type}/histories', [
                    'as'    => 'notice-types.histories',
                    'uses'  => 'NoticeTypesController@histories'
                ]);
                $router->get('notice-types/{notice_type}/revisions', [
                    'as'    => 'notice-types.revisions',
                    'uses'  => 'NoticeTypesController@revisions'
                ]);
                $router->post('notice-types/{notice_type}/duplicate', [
                    'as'    => 'notice-types.duplicate',
                    'uses'  => 'NoticeTypesController@duplicate'
                ]);
                $router->resource('notice-types', 'NoticeTypesController');
            });
        });
    }
}
