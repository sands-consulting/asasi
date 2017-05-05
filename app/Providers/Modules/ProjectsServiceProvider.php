<?php

namespace App\Providers\Modules;

use Gate;
use Illuminate\Support\ServiceProvider;

class ProjectsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::policy('App\Project', 'App\Policies\ProjectPolicy');
        Gate::policy('App\ProjectMilestone', 'App\Policies\ProjectMilestonePolicy');

        app('policy')->register('App\Http\Controllers\VendorProjectsController', 'App\Policies\ProjectPolicy');
        app('policy')->register('App\Http\Controllers\Admin\ProjectsController', 'App\Policies\ProjectPolicy');
        app('policy')->register('App\Http\Controllers\Admin\ProjectMilestonesController',
            'App\Policies\ProjectMilestonePolicy');
    }

    public function register()
    {
        app('router')->group([
            'namespace'  => 'App\Http\Controllers',
            'middleware' => 'web',
        ], function ($router) {
            $router->group([
                'namespace' => 'Admin',
                'prefix'    => 'admin',
                'as'        => 'admin.',
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
                    'as'   => 'projects.create-by-notice',
                    'uses' => 'ProjectsController@createByNotice',
                ]);

                $router->post('projects/store-by-notice', [
                    'as'   => 'projects.store-by-notice',
                    'uses' => 'ProjectsController@storeByNotice',
                ]);

                // Project Milestone
                $router->match(['get', 'post'], 'projects/{project}/milestones/gantt_data',
                    "ProjectMilestonesController@ganttData");
                $router->resource('projects.milestones', 'ProjectMilestonesController');
            });

            $router->resource('vendors.projects', 'VendorProjectsController', [
                'only' => ['index', 'show'],
            ]);
        });

        app('router')->group([
            'namespace'  => 'App\Http\Controllers\Api',
            'middleware' => 'api',
            'prefix'     => 'api',
            'as'         => 'api.',
        ], function ($router) {
            $router->get('projects/{project}/milestones/gantt-tasks', 'ProjectMilestonesController@getGanttTasks')
                ->name('projects.milestones.gantt-tasks');
            $router->put('projects/{project}/milestones/update-task', 'ProjectMilestonesController@updateTask')
                ->name('projects.milestones.update-task');
            $router->put('projects/{project}/milestones/update-rating', 'ProjectMilestonesController@updateRating')
                ->name('projects.milestones.update-rating');
        });
    }
}
