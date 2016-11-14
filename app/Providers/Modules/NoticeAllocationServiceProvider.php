<?php

namespace App\Providers\Modules;

use Illuminate\Support\ServiceProvider;

class NoticeAllocationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // app('policy')->register('App\Http\Controllers\Api\NoticeAllocationsController', 'App\Policies\NoticeAllocationsPolicy');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // api routing
        app('router')->group(['namespace' => 'App\Http\Controllers\Api', 'prefix' => 'api'], function ($router) {
            $router->model('allocation_notice', 'App\AllocationNotice');

            $router->post('notice-allocations/{notices}/store', [
                'as' => 'api.notice-allocations.store',
                'uses' => 'NoticeAllocationsController@store'
            ]);
            $router->post('notice-allocations/{notices}/update', [
                'as' => 'api.notice-allocations.update',
                'uses' => 'NoticeAllocationsController@update'
            ]);
            $router->post('notice-allocations/delete/{allocation_notice}', [
                'as' => 'api.notice-allocations.delete',
                'uses' => 'NoticeAllocationsController@delete'
            ]);
        });
    }
}
