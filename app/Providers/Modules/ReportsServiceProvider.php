<?php

namespace App\Providers\Modules;

use Illuminate\Support\ServiceProvider;

class ReportsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        app('policy')->register('App\Http\Controllers\Admin\SubmissionsController', 'App\Policies\SubmissionsPolicy');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        app('router')->group(['namespace' => 'App\Http\Controllers\Reports'], function ($router) {
            $router->get('reports',[
                'as' => 'reports',
                'uses' => 'ReportsController@index'
            ]);
            
            // Reports Vendor R1
            $router->get('reports/vendor/r1',[
                'as' => 'reports.vendor.r1',
                'uses' => 'VendorR1Controller@index'
            ]);
            $router->post('reports/vendor/r1',[
                'as' => 'reports.vendor.r1.view',
                'uses' => 'VendorR1Controller@view'
            ]);
            $router->get('reports/vendor/r1/excel', [
                'as' => 'reports.vendor.r1.excel',
                'uses' => 'VendorR1Controller@excel'
            ]);

            // Reports Vendor R2
            // $router->get('reports/vendor/r1',[
            //     'as' => 'reports.vendor.r1',
            //     'uses' => 'VendorR1Controller@index'
            // ]);
            // $router->post('reports/vendor/r1',[
            //     'as' => 'reports.vendor.r1.view',
            //     'uses' => 'VendorR1Controller@view'
            // ]);
            // $router->get('reports/vendor/r1/excel', [
            //     'as' => 'reports.vendor.r1.excel',
            //     'uses' => 'VendorR1Controller@excel'
            // ]);
        });
    }
}
