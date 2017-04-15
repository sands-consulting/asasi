<?php

namespace App\Providers\Modules;

use App\QualificationType;
use Gate;
use Illuminate\Support\ServiceProvider;

class QualificationsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::policy('App\QualificationCode', 'App\Policies\QualificationCodePolicy');
        Gate::policy('App\QualificationType', 'App\Policies\QualificationTypePolicy');

        app('policy')->register('App\Http\Controller\Admin\QualificationCodesController', 'App\Policies\QualificationCodePolicy');
        app('policy')->register('App\Http\Controller\Admin\QualificationTypesController', 'App\Policies\QualificationTypePolicy');
    }

    public function register()
    {
        app('router')->group([
            'namespace'  => 'App\Http\Controllers',
            'middleware' => 'web'
        ], function ($router) {
            $router->group([
                'namespace' => 'Admin',
                'prefix'    => 'admin',
                'as'        => 'admin.'
            ], function ($router) {
                $router->put('qualification-codes/{qualification_code}/restore', 'QualificationCodesController@restore')
                    ->name('qualification-codes.restore');
                $router->get('qualification-codes/{qualification_code}/revisions', 'QualificationCodesController@revisions')
                    ->name('qualification-codes.revisions');
                $router->get('qualification-codes/{qualification_code}/histories', 'QualificationCodesController@histories')
                    ->name('qualification-codes.histories');
                $router->get('qualification-codes/archives', 'QualificationCodesController@archives')
                    ->name('qualification-codes.archives');
                $router->put('qualification-codes/{qualification_code}/duplicate', 'QualificationCodesController@duplicate')
                    ->name('qualification-codes.duplicate');
                $router->resource('qualification-codes', 'QualificationCodesController');
                // Qualification Types
                $router->model('qualification_type', QualificationType::class);
                $router->put('qualification-types/{qualification_type}/restore', 'QualificationTypesController@restore')
                    ->name('qualification-types.restore');
                $router->get('qualification-types/{qualification_type}/revisions', 'QualificationTypesController@revisions')
                    ->name('qualification-types.revisions');
                $router->get('qualification-types/{qualification_type}/histories', 'QualificationTypesController@histories')
                    ->name('qualification-types.histories');
                $router->get('qualification-types/archives', 'QualificationTypesController@archives')
                    ->name('qualification-types.archives');
                $router->put('qualification-types/{qualification_type}/duplicate', 'QualificationTypesController@duplicate')
                    ->name('qualification-types.duplicate');
                $router->resource('qualification-types', 'QualificationTypesController');
            });
        });
    }
}
