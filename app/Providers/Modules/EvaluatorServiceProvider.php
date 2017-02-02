<?php

namespace App\Providers\Modules;

use Illuminate\Support\ServiceProvider;

class EvaluatorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app('policy')->register('App\Http\Controllers\Admin\EvaluatorsController', 'App\Policies\EvaluatorsPolicy');
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
                $router->get('evaluators/{notices}/index', [
                    'as' => 'evaluators.index',
                    'uses' => 'EvaluatorsController@index'
                ]);
                $router->get('evaluators/{notices}/create', [
                    'as' => 'evaluators.create',
                    'uses' => 'EvaluatorsController@create'
                ]);
                $router->post('evaluators/{notices}/store', [
                    'as' => 'evaluators.store',
                    'uses' => 'EvaluatorsController@store'
                ]);
                $router->get('evaluators/{notices}/edit', [
                    'as' => 'evaluators.edit',
                    'uses' => 'EvaluatorsController@edit'
                ]);
                $router->get('evaluators/{evaluators}/assign/{notices}', [
                    'as' => 'evaluators.assign',
                    'uses' => 'EvaluatorsController@assign'
                ]);
                $router->post('evaluators/{evaluators}/assigned/{notices}', [
                    'as' => 'evaluators.assigned',
                    'uses' => 'EvaluatorsController@assigned'
                ]);
                $router->get('evaluators/update', [
                    'as' => 'evaluators.update',
                    'uses' => 'EvaluatorsController@update'
                ]);
                $router->post('evaluators/{notices}/save', [
                    'as'    => 'evaluators.save',
                    'uses'  => 'EvaluatorsController@save'
                ]);
                $router->get('evaluators/{evaluators}/request', [
                    'as' => 'evaluators.request',
                    'uses' => 'EvaluatorsController@request'
                ]);
                $router->put('evaluators/{evaluators}/accept', [
                    'as' => 'evaluators.accept',
                    'uses' => 'EvaluatorsController@accept'
                ]);
                $router->put('evaluators/{evaluators}/decline', [
                    'as' => 'evaluators.decline',
                    'uses' => 'EvaluatorsController@decline'
                ]);
            });
        });
    }
}
