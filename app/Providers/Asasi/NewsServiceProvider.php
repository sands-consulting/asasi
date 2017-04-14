<?php

namespace App\Providers\Asasi;

use App\NewsCategory;
use Gate;
use Illuminate\Support\ServiceProvider;

class NewsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::policy('App\News', 'App\Policies\Asasi\NewsPolicy');
        Gate::policy('App\NewsCategory', 'App\Policies\Asasi\NewsCategoryPolicy');

        app('policy')->register('App\Http\Controllers\NewsController', 'App\Policies\Asasi\NewsPolicy');
        app('policy')->register('App\Http\Controllers\Admin\NewsController', 'App\Policies\Asasi\NewsPolicy');
        app('policy')->register('App\Http\Controllers\Admin\NewsCategoriesController', 'App\Policies\Asasi\NewsCategoryPolicy');
    }

    public function register()
    {
        app('router')->group([
            'namespace'  => 'App\Http\Controllers',
            'middleware' => 'web'
        ], function ($router) {
            $router->group([
                'namespace' => 'Admin',
                'prefix'    => 'admin',
                'as'        => 'admin.'
            ], function ($router) {
                $router->put('news/{news}/restore', 'NewsController@restore')
                    ->name('news.restore');
                $router->get('news/{news}/revisions', 'NewsController@revisions')
                    ->name('news.revisions');
                $router->get('news/{news}/histories', 'NewsController@histories')
                    ->name('news.histories');
                $router->get('news/archives', 'NewsController@archives')
                    ->name('news.archives');
                $router->put('news/{news}/duplicate', 'NewsController@duplicate')
                    ->name('news.duplicate');

                $router->put('news/{news}/publish', 'NewsController@publish')
                    ->name('news.publish');
                $router->put('news/{news}/restore', 'NewsController@unpublish')
                    ->name('news.unpublish');

                $router->resource('news', 'NewsController');

                // News Category
                $router->model('news_category', NewsCategory::class);
                $router->put('news-categories/{news_category}/restore', 'NewsCategoriesController@restore')
                    ->name('news-categories.restore');
                $router->get('news-categories/{news_category}/revisions', 'NewsCategoriesController@revisions')
                    ->name('news-categories.revisions');
                $router->get('news-categories/{news_category}/histories', 'NewsCategoriesController@histories')
                    ->name('news-categories.histories');
                $router->get('news-categories/archives', 'NewsCategoriesController@archives')
                    ->name('news-categories.archives');
                $router->put('news-categories/{news_category}/duplicate', 'NewsCategoriesController@duplicate')
                    ->name('news-categories.duplicate');
                $router->resource('news-categories', 'NewsCategoriesController');
            });

            $router->resource('news', 'NewsController', ['only' => ['index', 'show']]);
        });
    }
}
