<?php

namespace App\Providers\Modules;

use Illuminate\Support\ServiceProvider;

class RulesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app('policy')->register('App\Http\Controllers\Admin\RulesController', 'App\Policies\RulesPolicy');
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
            $router->model('rules', 'App\Rule');

            $router->post('rules/store', [
                'as' => 'api.rules.store',
                'uses' => 'RulesController@store'
            ]);
            $router->post('rules/update', [
                'as' => 'api.rules.update',
                'uses' => 'RulesController@update'
            ]);
            $router->post('rules/delete/{rules}', [
                'as' => 'api.rules.delete',
                'uses' => 'RulesController@delete'
            ]);
        });
    }
}
