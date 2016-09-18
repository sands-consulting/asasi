<?php

namespace App\Providers\Modules;

use Illuminate\Support\ServiceProvider;
use App\Filters\CustomSave;

class SubmissionServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // app('uploadable')->registerFilter('custom-save', CustomSave::class);
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
            $router->model('submissions', 'App\Submission');

            // admin
            $router->group(['namespace' => 'Admin', 'prefix' => 'admin'], function ($router) {
                $router->get('submissions/{notices}/lists', [
                    'as' => 'admin.submissions.lists',
                    'uses' => 'SubmissionsController@lists'
                ]);
                $router->get('submissions/{submissions}/evaluate', [
                    'as' => 'admin.submissions.evaluate',
                    'uses' => 'SubmissionsController@evaluate'
                ]);
                $router->resource('submissions', 'SubmissionsController');
            });

            // public
            $router->resource('submissions', 'SubmissionsController', ['only' => ['index']]);
        });

        // api routing
        app('router')->group(['namespace' => 'App\Http\Controllers\Api', 'prefix' => 'api'], function ($router) {
            $router->post('submissions/save', [
                'as' => 'submissions.save',
                'uses' => 'SubmissionsController@save'
            ]);
        });
    }
}
