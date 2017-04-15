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
            'middleware' => 'web'
        ], function ($router) {
            $router->get('reports', 'HomeController@index')
                ->name('reports');
        });
    }
}
