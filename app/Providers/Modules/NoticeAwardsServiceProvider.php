<?php

namespace App\Providers\Modules;

use Illuminate\Support\ServiceProvider;

class NoticeAwardsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
        app('router')->group(
            [
                'middleware' => 'web',
                'namespace' => 'App\Http\Controllers',
            ],
            function ($router) {
                $router->get('awards', 'NoticesController@awards')
                    ->name('awards');
            }
        );
    }
}
