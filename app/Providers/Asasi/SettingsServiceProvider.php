<?php

namespace App\Providers\Asasi;

use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app('router')->group([
            'namespace' => 'App\Http\Controllers',
            'middleware' => 'web',
        ], function ($router) {
            $router->get('settings', 'SettingsController@edit')
                ->name('settings');
            $router->put('settings', 'SettingsController@update');
        });
    }
}
