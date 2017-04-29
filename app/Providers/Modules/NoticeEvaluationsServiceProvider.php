<?php

namespace App\Providers\Modules;

use App\Evaluation;
use Gate;
use Illuminate\Support\ServiceProvider;

class NoticeEvaluationsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::policy('App\Evaluation', 'App\Policies\EvaluationPolicy');

        app('policy')->register('App\Http\Controllers\Admin\EvaluationsController', 'App\Policies\EvaluationPolicy');
    }

    public function register()
    {
        app('router')->group([
            'namespace'  => 'App\Http\Controllers',
            'middleware' => 'web'
        ], function ($router) {
            $router->group([
                'namespace' => 'Admin',
                'prefix'    => 'admin',
                'as'        => 'admin.',
            ], function ($router) {
                $router->model('evaluation', Evaluation::class);
                $router->get('evaluations/{evaluation}/revisions', 'EvaluationsController@revisions')
                    ->name('evaluations.revisions');
                $router->get('evaluations/{evaluation}/histories', 'EvaluationsController@histories')
                    ->name('evaluations.histories');
                $router->get('evaluations/accept', 'EvaluationsController@accept')
                    ->name('evaluations.accept');

                $router->resource('evaluations', 'EvaluationsController', [
                    'only' => ['index', 'show', 'edit', 'update'],
                ]);
            });
        });

        // API Routing
        $api = app('Dingo\Api\Routing\Router');
        $api->version('v1', function($api) {
            $api->group([
                'middleware' => ['api.auth', 'bindings'],
            ], function($api) {
                $api->get('evaluations', 'App\Http\Controllers\Api\EvaluationsController@index')
                    ->name('api.evaluations.index');
                $api->put('evaluations/accept', 'App\Http\Controllers\Api\EvaluationsController@accept')
                    ->name('api.evaluations.accept');
                $api->put('evaluations/reject', 'App\Http\Controllers\Api\EvaluationsController@reject')
                    ->name('api.evaluations.reject');
            });
        });
    }
}
