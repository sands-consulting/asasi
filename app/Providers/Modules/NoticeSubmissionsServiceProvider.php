<?php

namespace App\Providers\Modules;

use Illuminate\Support\ServiceProvider;
use App\Filters\CustomSave;

class NoticeSubmissionsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app('uploadable')->registerFilter('custom-save', CustomSave::class);
        app('policy')->register('App\Http\Controllers\Admin\SubmissionsController', 'App\Policies\SubmissionsPolicy');
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
            $router->group(['namespace' => 'Admin', 'prefix' => 'admin.'], function ($router) {
                $router->resource('notices.submissions', 'NoticeSubmissionsController');
            });

            $router->resource('vendors.submissions', 'VendorSubmissionsController', [
                'except' => 'destroy'
            ]);
        });
    }
}
