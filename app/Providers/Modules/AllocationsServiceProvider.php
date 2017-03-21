<?php

namespace App\Providers\Modules;

use Gate;
use App\News;
use Illuminate\Support\ServiceProvider;

class AllocationsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::policy('App\Allocation', 'App\Policies\AllocationPolicy');
        Gate::policy('App\AllocationType', 'App\Policies\AllocationTypePolicy');

        app('policy')->register('App\Http\Controllers\Admin\AllocationsController', 'App\Policies\AllocationPolicy');
        app('policy')->register('App\Http\Controllers\Admin\AllocationTypesController', 'App\Policies\AllocationTypePolicy');
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
                $router->put('allocations/{allocation}/restore', 'AllocationsController@restore')
                    ->name('allocations.restore');
                $router->get('allocations/{allocation}/revisions', 'AllocationsController@revisions')
                    ->name('allocations.revisions');
                $router->get('allocations/{allocation}/histories', 'AllocationsController@histories')
                    ->name('allocations.histories');
                $router->get('allocations/archives', 'AllocationsController@archives')
                    ->name('allocations.archives');
                $router->put('allocations/{allocation}/duplicate', 'AllocationsController@duplicate')
                    ->name('allocations.duplicate');
                $router->resource('allocations', 'AllocationsController');

                $router->put('allocation-types/{allocation_type}/restore', 'AllocationTypesController@restore')
                    ->name('allocation-types.restore');
                $router->get('allocation-types/{allocation_type}/revisions', 'AllocationTypesController@revisions')
                    ->name('allocation-types.revisions');
                $router->get('allocation-types/{allocation_type}/histories', 'AllocationTypesController@histories')
                    ->name('allocation-types.histories');
                $router->get('allocation-types/archives', 'AllocationTypesController@archives')
                    ->name('allocation-types.archives');
                $router->put('allocation-types/{allocation_type}/duplicate', 'AllocationTypesController@duplicate')
                    ->name('allocation-types.duplicate');
                $router->resource('allocation-types', 'AllocationTypesController');
            });
        });
    }
}
