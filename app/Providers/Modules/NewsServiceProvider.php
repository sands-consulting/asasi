<?php

namespace App\Providers\Modules;

use App\News;
use App\NewsCategory;
use Illuminate\Support\ServiceProvider;

class NewsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app('policy')->register('App\Http\Controllers\Admin\NewsController', 'App\Policies\NewsPolicy');
        app('policy')->register('App\Http\Controllers\Admin\NewsCategoriesController', 'App\Policies\NewsCategoriesPolicy');
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
                $router->resource('news', 'NewsController', ['except' => 'show']);
                
                $router->bind('news_categories', function($id) {
                    return NewsCategory::find($id);
                });
                $router->get('news-categories/{news_categories}/revisions', [
                    'as'    => 'admin.news-categories.revisions',
                    'uses'  => 'NewsCategoriesController@revisions'
                ]);
                $router->get('news-categories/{news_categories}/logs', [
                    'as'    => 'admin.news-categories.logs',
                    'uses'  => 'NewsCategoriesController@logs'
                ]);
                $router->resource('news-categories', 'NewsCategoriesController', ['except' => 'show']);
            });
        });
    }
}
