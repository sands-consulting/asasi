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
        app('router')->group(['namespace' => 'App\Http\Controllers'], function ($router) {
            $router->model('projects', 'App\Project');

            $router->group(['namespace' => 'Admin', 'prefix' => 'admin'], function ($router) {
                
                $router->get('projects/{projects}/revisions', [
                    'as'    => 'admin.projects.revisions',
                    'uses'  => 'ProjectsController@revisions'
                ]);
                $router->get('projects/{projects}/logs', [
                    'as'    => 'admin.projects.logs',
                    'uses'  => 'ProjectsController@logs'
                ]);

                $router->resource('projects', 'ProjectsController');
            });
        });
    }
}
