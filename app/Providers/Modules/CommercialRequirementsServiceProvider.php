<?php

namespace App\Providers\Modules;

use Illuminate\Support\ServiceProvider;

class CommercialRequirementsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app('policy')->register('App\Http\Controllers\Admin\CommercialRequirementsController', 'App\Policies\CommercialRequirementsPolicy');
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

            $router->post('requirement-commercials/store', [
                'as' => 'api.requirement-commercials.store',
                'uses' => 'CommercialRequirementsController@store'
            ]);
            $router->post('requirement-commercials/update', [
                'as' => 'api.requirement-commercials.update',
                'uses' => 'CommercialRequirementsController@update'
            ]);
            $router->post('requirement-commercials/delete/{requirement_commercials}', [
                'as' => 'api.requirement-commercials.delete',
                'uses' => 'CommercialRequirementsController@delete'
            ]);
        });
    }
}
