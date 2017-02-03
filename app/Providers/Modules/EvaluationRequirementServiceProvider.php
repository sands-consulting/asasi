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
        // Module Routing
        app('router')->group([
            'namespace' => 'App\Http\Controllers',
            'middleware' => 'web'
        ], function ($router) {
            $router->group([
                'namespace' => 'Admin',
                'prefix' => 'admin',
                'as' => 'admin.'
            ], function ($router) {
                $router->get('evaluation-requirements/{notices}/index', [
                    'as' => 'evaluation-requirements.index',
                    'uses' => 'EvaluationRequirementsController@index'
                ]);
                $router->get('evaluation-requirements/{notices}/create', [
                    'as' => 'evaluation-requirements.create',
                    'uses' => 'EvaluationRequirementsController@create'
                ]);
                $router->post('evaluation-requirements/store', [
                    'as' => 'evaluation-requirements.store',
                    'uses' => 'EvaluationRequirementsController@store'
                ]);
                $router->get('evaluation-requirements/{notices}/edit', [
                    'as' => 'evaluation-requirements.edit',
                    'uses' => 'EvaluationRequirementsController@edit'
                ]);
                $router->get('evaluation-requirements/update', [
                    'as' => 'evaluation-requirements.update',
                    'uses' => 'EvaluationRequirementsController@update'
                ]);
                $router->resource('evaluation-requirements', 'EvaluationRequirementsController', ['only' => ['show']]);

            });
        });

        // API Routing
        app('router')->group([
            'namespace' => 'App\Http\Controllers\Api',
            'prefix' => 'api',
            'middleware' => 'api'
        ], function ($router) {
            $router->post('evaluation-requirements/{notices}/store', [
                'as' => 'api.evaluation-requirements.store',
                'uses' => 'EvaluationRequirementsController@store'
            ]);
            $router->post('evaluation-requirements/update', [
                'as' => 'api.evaluation-requirements.update',
                'uses' => 'EvaluationRequirementsController@update'
            ]);
            $router->post('evaluation-requirements/delete/{evaluation_requirements}', [
                'as' => 'api.evaluation-requirements.delete',
                'uses' => 'EvaluationRequirementsController@delete'
            ]);
        });
    }
}
