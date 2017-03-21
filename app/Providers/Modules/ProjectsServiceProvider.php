<?php

namespace App\Providers\Modules;

use Gate;
use Illuminate\Support\ServiceProvider;

class ProjectsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::policy('App\Project', 'App\Policies\ProjectPolicy');

        app('policy')->register('App\Http\Controllers\VendorProjectsController', 'App\Policies\ProjectPolicy');
        app('policy')->register('App\Http\Controllers\Admin\ProjectsController', 'App\Policies\ProjectPolicy');
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
                $router->put('projects/{project}/restore', 'ProjectsController@restore')
                    ->name('projects.restore');
                $router->get('projects/{project}/revisions', 'ProjectsController@revisions')
                    ->name('projects.revisions');
                $router->get('projects/{project}/histories', 'ProjectsController@histories')
                    ->name('projects.histories');
                $router->get('projects/archives', 'ProjectsController@archives')
                    ->name('projects.archives');
                $router->put('projects/{project}/duplicate', 'ProjectsController@duplicate')
                    ->name('projects.duplicate');

                $router->put('projects/{project}/activate', 'ProjectsController@activate')
                    ->name('projects.activate');
                $router->put('projects/{project}/suspend', 'ProjectsController@suspend')
                    ->name('projects.suspend');

                $router->resource('projects', 'ProjectsController');
                
                # To Remove

                $router->post('projects/create-by-notice', [
                    'as'    => 'projects.create-by-notice',
                    'uses'  => 'ProjectsController@createByNotice'
                ]);

                $router->post('projects/store-by-notice', [
                    'as'    => 'projects.store-by-notice',
                    'uses'  => 'ProjectsController@storeByNotice'
                ]);
            });

            $router->resource('vendors.projects', 'VendorProjectsController', [
                'only' => ['index', 'show']]);
        });
    }
}
