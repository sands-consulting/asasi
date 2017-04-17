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

            });
        });
    }
}
