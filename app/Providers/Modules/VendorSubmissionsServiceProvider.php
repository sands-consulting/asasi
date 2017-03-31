<?php

namespace App\Providers\Modules;

use Gate;
use Illuminate\Support\ServiceProvider;

class VendorSubmissionsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::policy('App\Submission', 'App\Policies\SubmissionPolicy');

        app('policy')->register('App\Http\Controllers\Admin\EvaluationsController', 'App\Policies\EvaluationPolicy');
    }

    public function register()
    {
        app('router')->group(['namespace' => 'App\Http\Controllers', 'middleware' => 'web'], function ($router) {
            // Vendor Submissions
            $router->get('vendors/{vendor}/submissions/{submission}/slip', 'VendorSubmissionsController@slip')
                ->name('vendors.submissions.slip');

            $router->get('vendors/{vendor}/submissions/{submission}/types/{type}', 'VendorSubmissionsController@edit')
                ->name('vendors.submissions.edit');

            $router->resource('vendors.submissions', 'VendorSubmissionsController', [
                'except' => 'destroy',
            ]);
        });

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
