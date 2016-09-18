<?php

namespace App\Providers\Modules;

use Illuminate\Support\ServiceProvider;
use App\Filters\CustomSave;

class SubmissionServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app('uploadable')->registerFilter('custom-save', CustomSave::class);
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

            // admin
            $router->group(['namespace' => 'Admin', 'prefix' => 'admin'], function ($router) {
                $router->resource('notices', 'NoticesController');
            });

            // public
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
