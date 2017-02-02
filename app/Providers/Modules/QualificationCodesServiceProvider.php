<?php

namespace App\Providers\Modules;

use App\News;
use Illuminate\Support\ServiceProvider;

class QualificationCodesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app('policy')
            ->register('App\Http\Controllers\Admin\QualificationCodesController', 'App\Policies\QualificationCodesPolicy');
        app('policy')
            ->register('App\Http\Controllers\Admin\QualificationTypesController', 'App\Policies\QualificationTypesPolicy');
    }

    public function register()
    {
        // Module Routing
        app('router')->group([
            'namespace' => 'App\Http\Controllers',
            'middleware' => 'web'
        ], function ($router) {
            $router->group([
                'namespace' => 'Admin',
                'prefix' => 'admin',
                'as' => 'admin.'
            ], function ($router) {
                $router->get('qualification-codes/{qualification_code}/revisions', [
                    'as'    => 'qualification-codes.revisions',
                    'uses'  => 'QualificationCodesController@revisions'
                ]);
                $router->get('qualification-codes/{qualification_code}/histories', [
                    'as'    => 'qualification-codes.histories',
                    'uses'  => 'QualificationCodesController@histories'
                ]);
                $router->resource('qualification-codes', 'QualificationCodesController');

                $router->get('qualification-types/{qualification_types}/revisions', [
                    'as'    => 'qualification-types.revisions',
                    'uses'  => 'QualificationTypesController@revisions'
                ]);
                $router->get('qualification-types/{qualification_types}/histories', [
                    'as'    => 'qualification-types.histories',
                    'uses'  => 'QualificationTypesController@histories'
                ]);
                $router->resource('qualification-types', 'QualificationTypesController');
            });
        });
    }
}
