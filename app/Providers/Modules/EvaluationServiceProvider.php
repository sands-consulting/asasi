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

            $router->group(['namespace' => 'Api', 'prefix' => 'api'], function ($router) {
                $router->post('evaluations/store', [
                    'as' => 'api.evaluations.store',
                    'uses' => 'EvaluationsController@store'
                ]);
                $router->post('evaluations/update', [
                    'as' => 'api.evaluations.update',
                    'uses' => 'EvaluationsController@update'
                ]);
                $router->post('evaluations/delete/{evaluations}', [
                    'as' => 'api.evaluations.delete',
                    'uses' => 'EvaluationsController@delete'
                ]);
            });
        });
    }
}
