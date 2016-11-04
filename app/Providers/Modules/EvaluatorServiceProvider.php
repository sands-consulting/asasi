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
        // module routing
        app('router')->group(['namespace' => 'App\Http\Controllers'], function ($router) {
            $router->model('evaluators', 'App\NoticeEvaluator');

            $router->group(['namespace' => 'Admin', 'prefix' => 'admin'], function ($router) {
                
                $router->get('evaluators/{notices}/index', [
                    'as' => 'admin.evaluators.index',
                    'uses' => 'EvaluatorsController@index'
                ]);
                $router->get('evaluators/{notices}/create', [
                    'as' => 'admin.evaluators.create',
                    'uses' => 'EvaluatorsController@create'
                ]);
                $router->post('evaluators/{notices}/store', [
                    'as' => 'admin.evaluators.store',
                    'uses' => 'EvaluatorsController@store'
                ]);
                $router->get('evaluators/{notices}/edit', [
                    'as' => 'admin.evaluators.edit',
                    'uses' => 'EvaluatorsController@edit'
                ]);
                $router->get('evaluators/{evaluators}/assign/{notices}', [
                    'as' => 'admin.evaluators.assign',
                    'uses' => 'EvaluatorsController@assign'
                ]);
                $router->post('evaluators/{evaluators}/assigned/{notices}', [
                    'as' => 'admin.evaluators.assigned',
                    'uses' => 'EvaluatorsController@assigned'
                ]);
                $router->get('evaluators/update', [
                    'as' => 'admin.evaluators.update',
                    'uses' => 'EvaluatorsController@update'
                ]);
                $router->post('evaluators/{notices}/save', [
                    'as'    => 'admin.evaluators.save',
                    'uses'  => 'EvaluatorsController@save'
                ]);
                $router->get('evaluators/{evaluators}/request', [
                    'as' => 'admin.evaluators.request',
                    'uses' => 'EvaluatorsController@request'
                ]);
                $router->put('evaluators/{evaluators}/accept', [
                    'as' => 'admin.evaluators.accept',
                    'uses' => 'EvaluatorsController@accept'
                ]);
                $router->put('evaluators/{evaluators}/decline', [
                    'as' => 'admin.evaluators.decline',
                    'uses' => 'EvaluatorsController@decline'
                ]);
            });

            $router->group(['namespace' => 'Api', 'prefix' => 'api'], function ($router) {
                $router->post('evaluators/{notices}/store', [
                    'as' => 'api.evaluators.store',
                    'uses' => 'EvaluatorsController@store'
                ]);
                $router->post('evaluators/update', [
                    'as' => 'api.evaluators.update',
                    'uses' => 'EvaluatorsController@update'
                ]);
                $router->post('evaluators/delete/{evaluation_requirements}', [
                    'as' => 'api.evaluators.delete',
                    'uses' => 'EvaluatorsController@delete'
                ]);
            });
        });
    }
}
