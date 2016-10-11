<?php

namespace App\Providers\Modules;

use Illuminate\Support\ServiceProvider;

class EvaluationRequirementServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app('policy')->register('App\Http\Controllers\Admin\EvaluationRequirementsController', 'App\Policies\EvaluationRequirementsPolicy');
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
            $router->model('evaluation-requirements', 'App\EvaluationRequirement');

            $router->group(['namespace' => 'Admin', 'prefix' => 'admin'], function ($router) {
                
                $router->get('evaluation-requirements/{notices}/create', [
                    'as' => 'admin.evaluation-requirements.create',
                    'uses' => 'EvaluationRequirementsController@create'
                ]);
                $router->post('evaluation-requirements/store', [
                    'as' => 'admin.evaluation-requirements.store',
                    'uses' => 'EvaluationRequirementsController@store'
                ]);
                $router->get('evaluation-requirements/{notices}/edit', [
                    'as' => 'admin.evaluation-requirements.edit',
                    'uses' => 'EvaluationRequirementsController@edit'
                ]);
                $router->get('evaluation-requirements/update', [
                    'as' => 'admin.evaluation-requirements.update',
                    'uses' => 'EvaluationRequirementsController@update'
                ]);
                $router->resource('evaluation-requirements', 'EvaluationRequirementsController', ['only' => ['index', 'show']]);

            });

            $router->group(['namespace' => 'Api', 'prefix' => 'api'], function ($router) {
                $router->post('evaluation-requirements/{notices}/store', [
                    'as' => 'api.evaluation-requirements.store',
                    'uses' => 'EvaluationRequirementsController@store'
                ]);
                $router->post('evaluation-requirements/update', [
                    'as' => 'api.evaluation-requirements.update',
                    'uses' => 'EvaluationRequirementsController@update'
                ]);
                $router->post('evaluation-requirements/delete/{evaluations}', [
                    'as' => 'api.evaluation-requirements.delete',
                    'uses' => 'EvaluationRequirementsController@delete'
                ]);
            });
        });
    }
}
