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
                $router->get('evaluations/{notices}/submission', [
                    'as' => 'admin.evaluations.submission',
                    'uses' => 'EvaluationsController@submission'  
                ]);

                $router->get('evaluations/{notices}/{submissions}/create', [
                    'as' => 'admin.evaluations.create',
                    'uses' => 'EvaluationsController@create'  
                ]);

                $router->get('evaluations/{notices}/{submissions}/edit', [
                    'as' => 'admin.evaluations.edit',
                    'uses' => 'EvaluationsController@edit'  
                ]);

                $router->put('evaluations/{notices}/{submissions}/update', [
                    'as' => 'admin.evaluations.update',
                    'uses' => 'EvaluationsController@update'  
                ]);

                $router->post('evaluations/{notices}/{submissions}/store/', [
                    'as' => 'admin.evaluations.store',
                    'uses' => 'EvaluationsController@store'  
                ]);

                $router->get('evaluations/settings', [
                    'as' => 'admin.evaluations.settings',
                    'uses' => 'EvaluationsController@settings'  
                ]);

                $router->get('evaluations/{notices}/requirements', [
                    'as' => 'admin.evaluations.requirements',
                    'uses' => 'EvaluationsController@requirements'  
                ]);

                $router->get('evaluations/{notices}/summary', [
                    'as' => 'admin.evaluations.summary',
                    'uses' => 'EvaluationsController@summary'  
                ]);

                $router->resource('evaluations', 'EvaluationsController', ['only' => ['index']]);
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
