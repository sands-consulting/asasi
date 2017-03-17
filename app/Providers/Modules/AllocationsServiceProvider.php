<?php

namespace App\Providers\Modules;

use Gate;
use App\News;
use Illuminate\Support\ServiceProvider;

class AllocationsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::policy("App\Allocation", "App\Policies\AllocationPolicy");
        app('policy')
            ->register('App\Http\Controllers\Admin\AllocationsController', 'App\Policies\AllocationPolicy');
        app('policy')
            ->register('App\Http\Controllers\Admin\AllocationTypesController', 'App\Policies\AllocationTypePolicy');
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
                $router->get('allocations/{allocation}/revisions', [
                    'as'    => 'allocations.revisions',
                    'uses'  => 'AllocationsController@revisions'
                ]);
                $router->get('allocations/{allocation}/histories', [
                    'as'    => 'allocations.histories',
                    'uses'  => 'AllocationsController@histories'
                ]);
                $router->resource('allocations', 'AllocationsController');

                $router->get('allocation-types/{allocation_type}/revisions', [
                    'as'    => 'allocation-types.revisions',
                    'uses'  => 'AllocationTypesController@revisions'
                ]);
                $router->get('allocation-types/{allocation_type}/histories', [
                    'as'    => 'allocation-types.histories',
                    'uses'  => 'AllocationTypesController@histories'
                ]);
                $router->resource('allocation-types', 'AllocationTypesController');
            });
        });
    }
}
