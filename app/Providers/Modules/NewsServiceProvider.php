<?php

namespace App\Providers\Modules;

use App\News;
use Illuminate\Support\ServiceProvider;

class NewsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app('policy')->register('App\Http\Controllers\Admin\NewsController', 'App\Policies\NewsPolicy');
        app('policy')->register('App\Http\Controllers\Admin\NewsCategoryController', 'App\Policies\NewsCategoryPolicy');
    }

    public function register()
    {
        app('router')->group(['namespace' => 'App\Http\Controllers'], function ($router) {
            $router->model('news', 'App\News');
            $router->resource('news', 'NewsController', ['only' => ['index', 'show']]);

            $router->group(['namespace' => 'Admin', 'prefix' => 'admin'], function ($router) {
                $router->bind('news', function ($id) {
                    return News::find($id);
                });

                $router->get('news/{news}/revisions', [
                    'as'    => 'admin.news.revisions',
                    'uses'  => 'NewsController@revisions'
                ]);
                $router->get('news/{news}/logs', [
                    'as'    => 'admin.news.logs',
                    'uses'  => 'NewsController@logs'
                ]);
                $router->put('news/{news}/publish', [
                    'as'    => 'admin.news.publish',
                    'uses'  => 'NewsController@publish'
                ]);
                $router->put('news/{news}/unpublish', [
                    'as'    => 'admin.news.unpublish',
                    'uses'  => 'NewsController@unpublish'
                ]);
                $router->resource('news',  'NewsController', ['except' => 'show']);
            });
        });
    }
}
