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
        // module routing
        app('router')->group(['namespace' => 'App\Http\Controllers'], function ($router) {
            $router->model('comm_requirements', 'App\CommRequirement');

            $router->group(['namespace' => 'Admin', 'prefix' => 'admin'], function ($router) {
                $router->put('requirement-commercials/{comm_requirements}/activate', [
                    'as'    => 'admin.requirement-commercials.activate',
                    'uses'  => 'CommRequirementsController@activate'
                ]);
                $router->put('requirement-commercials/{comm_requirements}/deactivate', [
                    'as'    => 'admin.requirement-commercials.deactivate',
                    'uses'  => 'CommRequirementsController@deactivate'
                ]);
                $router->get('requirement-commercials/{comm_requirements}/logs', [
                    'as'    => 'admin.requirement-commercials.logs',
                    'uses'  => 'CommRequirementsController@logs'
                ]);
                $router->get('requirement-commercials/{comm_requirements}/revisions', [
                    'as'    => 'admin.requirement-commercials.revisions',
                    'uses'  => 'CommRequirementsController@revisions'
                ]);
                $router->post('requirement-commercials/{comm_requirements}/duplicate', [
                    'as'    => 'admin.requirement-commercials.duplicate',
                    'uses'  => 'CommRequirementsController@duplicate'
                ]);
                $router->resource('requirement-commercials', 'CommRequirementsController');
            });
        });
    }
}
