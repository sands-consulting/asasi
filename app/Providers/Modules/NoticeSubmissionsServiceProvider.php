<?php

namespace App\Providers\Modules;

use App\Filters\CustomSave;
use Gate;
use Illuminate\Support\ServiceProvider;

class NoticeSubmissionsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::policy('App\Submission', 'SubmissionPolicy');

        app('policy')->register('App\Http\Controllers\Admin\SubmissionsController', 'App\Policies\SubmissionPolicy');

        app('uploadable')->registerFilter('custom-save', CustomSave::class);
    }

    public function register()
    {
        app('router')->group(
            [
                'middleware' => 'web',
                'namespace' => 'App\Http\Controllers',
            ],
            function ($router) {
                $router->group(['namespace' => 'Admin', 'prefix' => 'admin.'], function ($router) {
                    $router->resource('notices.submissions', 'NoticeSubmissionsController');
                });
            }
        );
    }
}
