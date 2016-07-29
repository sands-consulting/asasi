<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ModelNamesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        app('policy')->register('App\Http\Controllers\ModelNamesController', 'App\Policies\ModelNamesPolicy');
        app('policy')->register('App\Http\Controllers\Admin\ModelNamesController', 'App\Policies\ModelNamesPolicy');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        // module routing
        app('router')->group(['namespace' => 'App\Http\Controllers'], function ($router) {
            $router->model('model_names', 'App\ModelName');

            $router->group(['namespace' => 'Admin', 'prefix' => 'admin'], function ($router) {
                $router->get('model-names/{model_names}/revisions', [
                    'as'    => 'admin.model-names.revisions',
                    'uses'  => 'ModelNamesController@revisions'
                ]);
                $router->put('model-names/{model_names}/activate', [
                    'as'    => 'admin.model-names.activate',
                    'uses'  => 'ModelNamesController@activate'
                ]);
                $router->put('model-names/{model_names}/deactivate', [
                    'as'    => 'admin.model-names.deactivate',
                    'uses'  => 'ModelNamesController@deactivate'
                ]);
                $router->resource('model-names', 'ModelNamesController');
            });

            $router->resource('model-names', 'ModelNamesController');
        });
    }
}
