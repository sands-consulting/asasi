<?php

namespace App\Providers\Modules;

use Gate;
use Illuminate\Support\ServiceProvider;

class NoticeEvaluationsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::policy('App\NoticeEvaluator', 'App\Policies\NoticeEvaluatorPolicy');
        
        app('policy')->register('App\Http\Controllers\Admin\EvaluationsController', 'App\Policies\EvaluationsPolicy');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        app('router')->group([
            'namespace' => 'App\Http\Controllers',
            'middleware' => 'web'
        ], function ($router) {
            $router->group([
                'namespace' => 'Admin',
                'prefix' => 'admin',
                'as' => 'admin.'
            ], function ($router) {
                $router->get('evaluations/{news}/revisions', 'EvaluationsController@revisions')
                    ->name('evaluations.revisions');
                $router->get('evaluations/{news}/histories', 'EvaluationsController@histories')
                    ->name('evaluations.histories');

                $router->put('evaluations/{evaluation}/accept', 'EvaluationsController@accept')
                    ->name('evalutions.accept');
                $router->put('evaluations/{evaluation}/reject', 'EvaluationsController@reject')
                    ->name('evalutions.accept');

                $router->resource('evaluations', 'EvaluationsController', [
                    'only' => ['index', 'show', 'edit', 'update']]);
            });
        });

        // API Routing
        app('router')->group([
            'namespace' => 'App\Http\Controllers\Api',
            'prefix' => 'api',
            'middleware' => 'api'
        ], function ($router) {
            $router->resource('users', 'EvaluationsController', [
                'only' => ['index', 'store']]);
        });
    }
}
