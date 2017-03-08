<?php

namespace App\Providers\Modules;

use Illuminate\Support\ServiceProvider;
use App\Filters\CustomSave;

class SubmissionServiceProvider extends ServiceProvider
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
                $router->get('submissions/{notices}/lists', [
                    'as' => 'admin.submissions.lists',
                    'uses' => 'SubmissionsController@lists'
                ]);
                $router->get('submissions/{submission}/evaluate', [
                    'as' => 'admin.submissions.evaluate',
                    'uses' => 'SubmissionsController@evaluate'
                ]);
                $router->resource('submissions', 'SubmissionsController');
            });

            $router->resource('vendors.submissions', 'VendorSubmissionsController', [
                'except' => 'destroy'
            ]);
        });
    }
}
