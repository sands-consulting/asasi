<?php

namespace App\Providers\Modules;

use Illuminate\Support\ServiceProvider;

class ReportsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
         app('router')->group([
            'namespace' => 'App\Http\Controllers\Reports',
            'middleware' => ['web', 'auth']
        ], function ($router) {
            $router->get('reports', function() {
                return view('reports.index');
            })->name('reports');

            $router->group([
                'prefix' => 'reports',
                'as' => 'reports.'
            ], function($router) {

                // Vendor - List all vendors
                $router->get('rv1', 'Rv1Controller@create');
                $router->get('rv1/view', 'Rv1Controller@show');
                $router->get('rv1/excel', 'Rv1Controller@excel');
                $router->get('rv1/print', 'Rv1Controller@print');

                // Vendor - List new vendors
                $router->get('rv2', 'Rv2Controller@create');
                $router->get('rv2/view', 'Rv2Controller@show');
                $router->get('rv2/excel', 'Rv2Controller@excel');
                $router->get('rv2/print', 'Rv2Controller@print');

            });
        });
    }
}
