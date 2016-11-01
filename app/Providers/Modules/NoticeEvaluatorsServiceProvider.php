<?php

namespace App\Providers\Modules;

use Illuminate\Support\ServiceProvider;

class NoticeEvaluatorsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // boot
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
            $router->model('notice_evaluator', 'App\NoticeEvaluator');
        });
    }
}
