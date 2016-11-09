<?php

namespace App\Providers\Modules;

use Illuminate\Support\ServiceProvider;

class BookmarksServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // app('policy')->register('App\Http\Controllers\BookmarksController', 'App\Policies\BookmarksPolicy');
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
            $router->model('bookmarks', 'App\Bookmark');
            $router->post('bookmarks/{notices}/add', [
                'uses' => 'BookmarksController@add',
                'as' => 'bookmarks.add'
            ]);

            $router->post('bookmarks/{notices}/remove', [
                'uses' => 'BookmarksController@remove',
                'as' => 'bookmarks.remove'
            ]);

            $router->resource('bookmarks', 'BookmarksController');
        });
    }
}
