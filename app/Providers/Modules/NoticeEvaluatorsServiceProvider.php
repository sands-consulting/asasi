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
        // Module Routing
        app('router')->group(['namespace' => 'App\Http\Controllers'], function ($router) {
        });
    }
}
