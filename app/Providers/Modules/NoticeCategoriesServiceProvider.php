<?php

namespace App\Providers\Modules;

use Illuminate\Support\ServiceProvider;

class NoticeCategoriesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app('policy')->register('App\Http\Controllers\Admin\NoticeCategoriesController', 'App\Policies\NoticeCategoriesPolicy');
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
            $router->model('notice_categories', 'App\NoticeCategory');

            $router->group(['namespace' => 'Admin', 'prefix' => 'admin'], function ($router) {
                $router->put('notice-categories/{notice_categories}/activate', [
                    'as'    => 'admin.notice-categories.activate',
                    'uses'  => 'NoticeCategoriesController@activate'
                ]);
                $router->put('notice-categories/{notice_categories}/deactivate', [
                    'as'    => 'admin.notice-categories.deactivate',
                    'uses'  => 'NoticeCategoriesController@deactivate'
                ]);
                $router->get('notice-categories/{notice_categories}/logs', [
                    'as'    => 'admin.notice-categories.logs',
                    'uses'  => 'NoticeCategoriesController@logs'
                ]);
                $router->get('notice-categories/{notice_categories}/revisions', [
                    'as'    => 'admin.notice-categories.revisions',
                    'uses'  => 'NoticeCategoriesController@revisions'
                ]);
                $router->post('notice-categories/{notice_categories}/duplicate', [
                    'as'    => 'admin.notice-categories.duplicate',
                    'uses'  => 'NoticeCategoriesController@duplicate'
                ]);
                $router->resource('notice-categories', 'NoticeCategoriesController');
            });
        });
    }
}
