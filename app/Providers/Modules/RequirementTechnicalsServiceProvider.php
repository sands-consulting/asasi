<?php

namespace App\Providers\Modules;

use Illuminate\Support\ServiceProvider;

class RequirementTechnicalsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app('policy')->register('App\Http\Controllers\Admin\RequirementTechnicalsController', 'App\Policies\RequirementTechnicalsPolicy');
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
            $router->model('requirement_technicals', 'App\RequirementTechnical');

            $router->post('requirement-technicals/store', [
                'as' => 'api.requirement-technicals.store',
                'uses' => 'RequirementTechnicalsController@store'
            ]);
            $router->post('requirement-technicals/update', [
                'as' => 'api.requirement-technicals.update',
                'uses' => 'RequirementTechnicalsController@update'
            ]);
            $router->post('requirement-technicals/delete/{requirement_technicals}', [
                'as' => 'api.requirement-technicals.delete',
                'uses' => 'RequirementTechnicalsController@delete'
            ]);
        });
    }
}
