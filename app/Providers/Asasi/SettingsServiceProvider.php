<?php

namespace App\Providers\Asasi;

use Gate;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::policy('App\Setting', 'App\Policies\Asasi\SettingPolicy');

        app('policy')->register('App\Http\Controllers\Admin\SettingsController', 'App\Policies\Asasi\SettingPolicy');
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
            $router->group([
                'namespace' => 'Admin',
                'prefix' => 'admin',
            ], function ($router) {
                $router->get('settings', 'SettingsController@edit')
                    ->name('settings');
                $router->put('settings', 'SettingsController@update');
                $router->put('license', 'SettingsController@license')
                    ->name('license');
            });
        });
    }
}
