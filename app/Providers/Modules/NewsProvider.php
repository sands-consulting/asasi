<?php

namespace App\Providers\Modules;

use App\News;
use Illuminate\Support\ServiceProvider;

class NewsProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        # Register admin policy
        app('policy')->register('App\Http\Controllers\Admin\NewsController', 'App\Policies\NewsPolicy');
        app('policy')->register('App\Http\Controllers\Admin\NewsCategoryController', 'App\Policies\NewsCategoryPolicy');

        # Register admin routing
        app('router')->group([
            'namespace' => 'App\Http\Controllers'
        ], function($router) {
            $router->model('news', 'App\News');
            $router->resource('news', 'NewsController', ['only' => ['index', 'show']]);
        });
    }
}
