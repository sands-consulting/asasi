<?php

namespace App\Providers\Modules;

use Illuminate\Support\ServiceProvider;

class EvaluationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app('policy')->register('App\Http\Controllers\Admin\EvaluationsController', 'App\Policies\EvaluationsPolicy');
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
            $router->model('evaluations', 'App\Evaluation');

            $router->group(['namespace' => 'Admin', 'prefix' => 'admin'], function ($router) {
                $router->get('evaluations/{type}/vendors', [
                    'as' => 'admin.evaluations.vendors',
                    'uses' => 'EvaluationsController@vendors'  
                ]);

                $router->get('evaluations/{submissions}/evaluate', [
                    'as' => 'admin.evaluations.evaluate',
                    'uses' => 'EvaluationsController@evaluate'  
                ]);

                $router->resource('evaluations', 'EvaluationsController');
            });
        });
    }
}
