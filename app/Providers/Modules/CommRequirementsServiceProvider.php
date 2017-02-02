<?php

namespace App\Providers\Modules;

use Illuminate\Support\ServiceProvider;

class CommRequirementsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app('policy')->register('App\Http\Controllers\Admin\CommRequirementsController', 'App\Policies\CommRequirementsPolicy');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Module routing
        app('router')->group([
            'namespace' => 'App\Http\Controllers',
            'middleware' => 'web'
        ], function ($router) {
            $router->group([
                'namespace' => 'Admin',
                'prefix' => 'admin',
                'as' => 'admin.'
            ], function ($router) {
                $router->put('requirement-commercials/{comm_requirements}/activate', [
                    'as'    => 'requirement-commercials.activate',
                    'uses'  => 'CommRequirementsController@activate'
                ]);
                $router->put('requirement-commercials/{comm_requirements}/deactivate', [
                    'as'    => 'requirement-commercials.deactivate',
                    'uses'  => 'CommRequirementsController@deactivate'
                ]);
                $router->get('requirement-commercials/{comm_requirements}/histories', [
                    'as'    => 'requirement-commercials.histories',
                    'uses'  => 'CommRequirementsController@histories'
                ]);
                $router->get('requirement-commercials/{comm_requirements}/revisions', [
                    'as'    => 'requirement-commercials.revisions',
                    'uses'  => 'CommRequirementsController@revisions'
                ]);
                $router->post('requirement-commercials/{comm_requirements}/duplicate', [
                    'as'    => 'requirement-commercials.duplicate',
                    'uses'  => 'CommRequirementsController@duplicate'
                ]);
                $router->resource('requirement-commercials', 'CommRequirementsController');
            });
        });
    }
}
