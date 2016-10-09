<?php

namespace App\Providers\Modules;

use Illuminate\Support\ServiceProvider;

class RequirementCommercialsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app('policy')->register('App\Http\Controllers\Admin\RequirementCommercialsController', 'App\Policies\RequirementCommercialsPolicy');
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
            $router->model('requirement_commercials', 'App\RequirementCommercial');

            $router->post('requirement-commercials/{notices}/store', [
                'as' => 'api.requirement-commercials.store',
                'uses' => 'RequirementCommercialsController@store'
            ]);
            $router->post('requirement-commercials/update', [
                'as' => 'api.requirement-commercials.update',
                'uses' => 'RequirementCommercialsController@update'
            ]);
            $router->post('requirement-commercials/delete/{requirement_commercials}', [
                'as' => 'api.requirement-commercials.delete',
                'uses' => 'RequirementCommercialsController@delete'
            ]);
        });
    }
}
