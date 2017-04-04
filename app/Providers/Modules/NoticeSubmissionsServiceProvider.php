<?php

namespace App\Providers\Modules;

use App\Filters\CustomSave;
use Gate;
use Illuminate\Support\ServiceProvider;

class NoticeSubmissionsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::policy('App\Submission', 'App\Policies\SubmissionPolicy');

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

                $router->get('vendors/{vendor}/submissions/{submission}/slip', 'VendorSubmissionsController@slip')
                    ->name('vendors.submissions.slip');
                $router->get('vendors/{vendor}/submissions/{submission}/types/{type}', 'VendorSubmissionsController@edit')
                    ->name('vendors.submissions.edit');

                $router->resource('vendors.submissions', 'VendorSubmissionsController', [
                    'except' => 'destroy',
                ]);

                $router->get('submissions', 'NoticesController@submissions')
                    ->name('submissions');
            }
        );

        // API Routing
        app('router')->group([
            'namespace'  => 'App\Http\Controllers\Api',
            'prefix'     => 'api',
            'middleware' => 'api',
        ], function ($router) {
            $router->get('vendor-submissions/{submission}/notice', 'VendorSubmissionsController@getNotice');
            $router->get('vendor-submissions/{submission}/submission', 'VendorSubmissionsController@getSubmission');
        });
    }
}
