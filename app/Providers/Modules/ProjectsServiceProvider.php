<?php

namespace App\Providers\Modules;

use App\News;
use Illuminate\Support\ServiceProvider;

class ProjectsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app('policy')->register('App\Http\Controllers\Admin\ProjectsController', 'App\Policies\ProjectsPolicy');
    }

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
                $router->get('projects/{projects}/revisions', [
                    'as'    => 'projects.revisions',
                    'uses'  => 'ProjectsController@revisions'
                ]);
                $router->get('projects/{projects}/histories', [
                    'as'    => 'projects.histories',
                    'uses'  => 'ProjectsController@histories'
                ]);

                $router->post('projects/create-by-notice', [
                    'as'    => 'projects.create-by-notice',
                    'uses'  => 'ProjectsController@createByNotice'
                ]);

                $router->post('projects/store-by-notice', [
                    'as'    => 'projects.store-by-notice',
                    'uses'  => 'ProjectsController@storeByNotice'
                ]);

                $router->resource('projects', 'ProjectsController');
            });
        });
    }
}
