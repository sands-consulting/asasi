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
            ->register('App\Http\Controllers\Admin\AllocationTypesController', 'App\Policies\AllocationTypesPolicy');
    }

    public function register()
    {
        app('router')->group(['namespace' => 'App\Http\Controllers'], function ($router) {
            $router->model('allocations', 'App\Allocation');
            $router->model('allocation_types', 'App\AllocationType');

            $router->group(['namespace' => 'Admin', 'prefix' => 'admin'], function ($router) {
                $router->get('allocations/{allocations}/revisions', [
                    'as'    => 'admin.allocations.revisions',
                    'uses'  => 'AllocationsController@revisions'
                ]);
                $router->get('allocations/{allocations}/logs', [
                    'as'    => 'admin.allocations.logs',
                    'uses'  => 'AllocationsController@logs'
                ]);
                $router->resource('allocations', 'AllocationsController');

                $router->get('allocation-types/{allocation_types}/revisions', [
                    'as'    => 'admin.allocation-types.revisions',
                    'uses'  => 'AllocationTypesController@revisions'
                ]);
                $router->get('allocation-types/{allocation_types}/logs', [
                    'as'    => 'admin.allocation-types.logs',
                    'uses'  => 'AllocationTypesController@logs'
                ]);
                $router->resource('allocation-types', 'AllocationTypesController');
            });
        });
    }
}
