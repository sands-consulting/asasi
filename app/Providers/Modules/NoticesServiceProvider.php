<?php

namespace App\Providers\Modules;

use Illuminate\Support\ServiceProvider;

class NoticesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app('policy')->register('App\Http\Controllers\Admin\NoticesController', 'App\Policies\NoticesPolicy');
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
            $router->model('notices', 'App\Notice');

            $router->group(['namespace' => 'Admin', 'prefix' => 'admin'], function ($router) {
                $router->put('notices/{notices}/publish', [
                    'as'    => 'admin.notices.publish',
                    'uses'  => 'NoticesController@publish'
                ]);
                $router->put('notices/{notices}/unpublish', [
                    'as'    => 'admin.notices.unpublish',
                    'uses'  => 'NoticesController@unpublish'
                ]);
                $router->get('notices/{notices}/logs', [
                    'as'    => 'admin.notices.logs',
                    'uses'  => 'NoticesController@logs'
                ]);
                $router->get('notices/{notices}/revisions', [
                    'as'    => 'admin.notices.revisions',
                    'uses'  => 'NoticesController@revisions'
                ]);
                $router->post('notices/{notices}/duplicate', [
                    'as'    => 'admin.notices.duplicate',
                    'uses'  => 'NoticesController@duplicate'
                ]);
                $router->resource('notices', 'NoticesController');
            });

            $router->get('notices/my-notices', [
                'as' => 'notices.my-notices',
                'uses' => 'NoticesController@myNotices'
            ]);
            $router->get('notices/{notices}/submission/', [
                'as' => 'notices.submission',
                'uses' => 'NoticesController@submission'
            ]);
            $router->post('notices/{notices}/commercial/', [
                'as' => 'notices.commercial',
                'uses' => 'NoticesController@commercial'
            ]);
            $router->post('notices/{notices}/store-commercial/', [
                'as' => 'notices.store-commercial',
                'uses' => 'NoticesController@storeCommercial'
            ]);
            $router->post('notices/{notices}/technical/', [
                'as' => 'notices.technical',
                'uses' => 'NoticesController@technical'
            ]);
            $router->post('notices/{notices}/store-technical/', [
                'as' => 'notices.store-technical',
                'uses' => 'NoticesController@storeTechnical'
            ]);
            
            $router->resource('notices', 'NoticesController', ['only' => ['index']]);
        });

        // api routing
        app('router')->group(['namespace' => 'App\Http\Controllers\Api', 'prefix' => 'api'], function ($router) {
            $router->post('notices/save', [
                'as' => 'notices.save',
                'uses' => 'NoticesController@save'
            ]);
        });
    }
}
