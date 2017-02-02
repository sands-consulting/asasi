<?php

namespace App\Providers\Modules;

use Illuminate\Support\ServiceProvider;

class ProjectMilestonesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app('policy')->register('App\Http\Controllers\Admin\ProjectMilestonesController', 'App\Policies\ProjectMilestonesPolicy');
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
                $router->match(['get', 'post'], 'projects/{projects}/milestones/gantt_data', "ProjectMilestonesController@ganttData");

                $router->resource('projects.milestones', 'ProjectMilestonesController');
            });

        });
    }
}
