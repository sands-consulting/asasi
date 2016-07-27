<?php

namespace App\Providers\Modules;

use App\News;
use Illuminate\Support\ServiceProvider;

class AllocationsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app('policy')
            ->register('App\Http\Controllers\Admin\AllocationsController', 'App\Policies\AllocationsPolicy');
        app('policy')
            ->register('App\Http\Controllers\Admin\AllocationTypeController', 'App\Policies\AllocationTypePolicy');
    }

    public function register()
    {
        app('router')->group(['namespace' => 'App\Http\Controllers'], function ($router) {
            $router->model('allocations', 'App\Allocation');
            $router->model('allocation_types', 'App\AllocationType');

            $router->group(['namespace' => 'Admin', 'prefix' => 'admin'], function ($router) {
                $router->get('allocations/{allocations}/revisions', [
                    'as'    => 'admin.allocations.revisions',
                    'uses'  => 'AllocationsControllerr@revisions'
                ]);
                $router->get('allocations/{allocations}/activate', [
                    'as'    => 'admin.allocations.activate',
                    'uses'  => 'AllocationsControllerr@deactivate'
                ]);
                $router->get('allocations/{allocations}/deactivate', [
                    'as'    => 'admin.allocations.activate',
                    'uses'  => 'AllocationsControllerr@deactivate'
                ]);
                $router->resource('allocations', 'AllocationsController');

                $router->get('allocation-types/{allocation_types}/revisions', [
                    'as'    => 'admin.allocation-types.revisions',
                    'uses'  => 'AllocationTypeController@revisions'
                ]);
                $router->get('allocation-types/{allocation_types}/activate', [
                    'as'    => 'admin.allocation-types.activate',
                    'uses'  => 'AllocationTypeController@activate'
                ]);
                $router->get('allocation-types/{allocation_types}/deactivate', [
                    'as'    => 'admin.allocation-types.deactivate',
                    'uses'  => 'AllocationTypeController@deactivate'
                ]);
                $router->resource('allocation-types', 'AllocationTypeController');
            });
        });
    }
}
