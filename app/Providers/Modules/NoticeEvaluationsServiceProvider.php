<?php

namespace App\Providers\Modules;

use Illuminate\Support\ServiceProvider;

class NoticeEvaluationsServiceProvider extends ServiceProvider
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
                $router->get('evaluations/{notices}/submission', [
                    'as' => 'evaluations.submission',
                    'uses' => 'EvaluationsController@submission'  
                ]);

                $router->get('evaluations/{notices}/{submissions}/create', [
                    'as' => 'evaluations.create',
                    'uses' => 'EvaluationsController@create'  
                ]);

                $router->get('evaluations/{notices}/{submissions}/edit', [
                    'as' => 'evaluations.edit',
                    'uses' => 'EvaluationsController@edit'  
                ]);

                $router->put('evaluations/{notices}/{submissions}/update', [
                    'as' => 'evaluations.update',
                    'uses' => 'EvaluationsController@update'  
                ]);

                $router->post('evaluations/{notices}/{submissions}/store', [
                    'as' => 'evaluations.store',
                    'uses' => 'EvaluationsController@store'  
                ]);

                $router->get('evaluations/settings', [
                    'as' => 'evaluations.settings',
                    'uses' => 'EvaluationsController@settings'  
                ]);

                $router->get('evaluations/{notices}/requirements', [
                    'as' => 'evaluations.requirements',
                    'uses' => 'EvaluationsController@requirements'  
                ]);

                $router->get('evaluations/{notices}/view/{users}/{submissions}', [
                    'as' => 'evaluations.view',
                    'uses' => 'EvaluationsController@view'
                ]);

                $router->resource('evaluations', 'EvaluationsController', ['only' => ['index']]);
            });
        });

         // API Routing
        app('router')->group([
            'namespace' => 'App\Http\Controllers\Api',
            'prefix' => 'api',
            'middleware' => 'api'
        ], function ($router) {
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
    }
}
