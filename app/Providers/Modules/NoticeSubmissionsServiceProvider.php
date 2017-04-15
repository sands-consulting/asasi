<?php

namespace App\Providers\Modules;

use App\Filters\CustomSave;
use App\SubmissionDetail;
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
                    $router->resource('submissions', 'SubmissionsController');
                });

                // vendor submissions
                $router->model('submission_detail', SubmissionDetail::class);
                $router->get('vendors/{vendor}/submissions/{submission}/slip', 'VendorSubmissionsController@slip')
                    ->name('vendors.submissions.slip');
                $router->get('vendors/{vendor}/submissions/{submission}/details/{submission_detail}/create',
                    'VendorSubmissionsController@create')
                    ->name('vendors.submissions.create');
                $router->get('vendors/{vendor}/submissions/{submission}/details/{submission_detail}/edit',
                    'VendorSubmissionsController@edit')
                    ->name('vendors.submissions.edit');
                $router->put('vendors/{vendor}/submissions/{submission}/details/{submission_detail}',
                    'VendorSubmissionsController@update')
                    ->name('vendors.submissions.update');
                $router->resource('vendors.submissions', 'VendorSubmissionsController', [
                    'except' => ['destroy', 'update'],
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
