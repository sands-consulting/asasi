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

                $router->post('projects/create-by-notice', [
                    'as'    => 'admin.projects.create-by-notice',
                    'uses'  => 'ProjectsController@createByNotice'
                ]);

                $router->post('projects/store-by-notice', [
                    'as'    => 'admin.projects.store-by-notice',
                    'uses'  => 'ProjectsController@storeByNotice'
                ]);

                $router->resource('projects', 'ProjectsController');
            });
        });
    }
}
