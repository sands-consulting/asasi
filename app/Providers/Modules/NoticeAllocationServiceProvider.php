<?php

namespace App\Providers\Modules;

use Illuminate\Support\ServiceProvider;

class NoticeAllocationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app('policy')->register('App\Http\Controllers\Admin\NoticeAllocationsController', 'App\Policies\NoticeAllocationsPolicy');
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
            $router->model('notice_allocations', 'App\NoticeAllocation');

            $router->post('notice-allocations/store', [
                'as' => 'api.notice-allocations.store',
                'uses' => 'NoticeAllocationsController@store'
            ]);
            $router->post('notice-allocations/update', [
                'as' => 'api.notice-allocations.update',
                'uses' => 'NoticeAllocationsController@update'
            ]);
            $router->post('notice-allocations/delete/{notice_allocations}', [
                'as' => 'api.notice-allocations.delete',
                'uses' => 'NoticeAllocationsController@delete'
            ]);
        });
    }
}
