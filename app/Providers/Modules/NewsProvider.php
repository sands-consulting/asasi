<?php

namespace App\Providers\Modules;

use App\News;
use Illuminate\Support\ServiceProvider;

class NewsProvider extends ServiceProvider
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
                $router->bind('news', function ($value) {
                    return News::find($value);
                });

                $router->get('news/{news}/revisions', [
                    'as'    => 'admin.news.revisions',
                    'uses'  => 'NewsController@revisions'
                ]);
                $router->get('news/{news}/publish', [
                    'as'    => 'admin.news.publish',
                    'uses'  => 'NewsController@publish'
                ]);
                $router->get('news/{news}/unpublish', [
                    'as'    => 'admin.news.unpublish',
                    'uses'  => 'NewsController@unpublish'
                ]);
                $router->resource('news',  'NewsController');
            });
        });
    }
}
