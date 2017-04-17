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

                $router->get('evaluations/{evaluation}/submission/{submission}/edit', 'EvaluationsController@edit')
                    ->name('evaluations.edit');
                $router->put('evaluations/{evaluation}/submission/{submission}', 'EvaluationsController@update')
                    ->name('evaluations.update');
                $router->put('evaluations/{evaluation}/accept', 'EvaluationsController@accept')
                    ->name('evalutions.accept');
                $router->put('evaluations/{evaluation}/reject', 'EvaluationsController@reject')
                    ->name('evalutions.accept');

                $router->resource('evaluations', 'EvaluationsController', [
                    'only' => ['index', 'show'],
                ]);
            });
        });

        // API Routing
        app('router')->group([
            'namespace'  => 'App\Http\Controllers\Api',
            'prefix'     => 'api',
            'middleware' => 'api'
        ], function ($router) {
            $router->resource('evaluations', 'EvaluationsController', [
                'only' => ['index', 'store']]);
        });
    }
}
