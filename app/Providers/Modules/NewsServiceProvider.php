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
                // News Routing
                $router->get('news/{news}/revisions', [
                    'as'    => 'news.revisions',
                    'uses'  => 'NewsController@revisions'
                ]);
                $router->get('news/{news}/histories', [
                    'as'    => 'news.histories',
                    'uses'  => 'NewsController@histories'
                ]);
                $router->put('news/{news}/publish', [
                    'as'    => 'news.publish',
                    'uses'  => 'NewsController@publish'
                ]);
                $router->put('news/{news}/unpublish', [
                    'as'    => 'news.unpublish',
                    'uses'  => 'NewsController@unpublish'
                ]);
                $router->resource('news', 'NewsController', ['except' => 'show']);

                // News Category Routing
                $router->get('news-categories/{news_categories}/revisions', [
                    'as'    => 'news-categories.revisions',
                    'uses'  => 'NewsCategoriesController@revisions'
                ]);
                $router->get('news-categories/{news_categories}/histories', [
                    'as'    => 'news-categories.histories',
                    'uses'  => 'NewsCategoriesController@histories'
                ]);
                $router->resource('news-categories', 'NewsCategoriesController', ['except' => 'show']);
            });

            $router->resource('news', 'NewsController', ['only' => ['index', 'show']]);
        });
    }
}
