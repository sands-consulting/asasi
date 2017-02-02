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
                $router->put('notice-categories/{notice_category}/activate', [
                    'as'    => 'admin.notice-categories.activate',
                    'uses'  => 'NoticeCategoriesController@activate'
                ]);
                $router->put('notice-categories/{notice_category}/deactivate', [
                    'as'    => 'admin.notice-categories.deactivate',
                    'uses'  => 'NoticeCategoriesController@deactivate'
                ]);
                $router->get('notice-categories/{notice_category}/histories', [
                    'as'    => 'admin.notice-categories.histories',
                    'uses'  => 'NoticeCategoriesController@histories'
                ]);
                $router->get('notice-categories/{notice_category}/revisions', [
                    'as'    => 'admin.notice-categories.revisions',
                    'uses'  => 'NoticeCategoriesController@revisions'
                ]);
                $router->post('notice-categories/{notice_category}/duplicate', [
                    'as'    => 'admin.notice-categories.duplicate',
                    'uses'  => 'NoticeCategoriesController@duplicate'
                ]);
                $router->resource('notice-categories', 'NoticeCategoriesController');
            });
        });
    }
}
