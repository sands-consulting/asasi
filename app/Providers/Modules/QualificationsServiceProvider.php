<?php

namespace App\Providers\Modules;

use Gate;
use Illuminate\Support\ServiceProvider;

class QualificationsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::policy('App\QualificationCode', 'App\Policies\QualificationCodePolicy');
        Gate::policy('App\QualificationType', 'App\Policies\QualificationTypePolicy');

        app('policy')->register('App\Http\Controllers\Admin\QualificationCodesController', 'App\Policies\QualificationCodePolicy');
        app('policy')->register('App\Http\Controllers\Admin\QualificationTypesController', 'App\Policies\QualificationTypePolicy');
    }

    public function register()
    {
        app('router')->group([
            'namespace' => 'App\Http\Controllers',
            'middleware' => 'web'
        ], function ($router) {
            $router->group([
                'namespace' => 'Admin',
                'prefix' => 'admin',
                'as' => 'admin.'
            ], function ($router) {
                $router->put('qualification-codes/{qualification_code}/restore', 'QualificationCodesControllers@restore')
                    ->name('qualification-codes.restore');
                $router->get('qualification-codes/{qualification_code}/revisions', 'QualificationCodesControllers@revisions')
                    ->name('qualification-codes.revisions');
                $router->get('qualification-codes/{qualification_code}/histories', 'QualificationCodesControllers@histories')
                    ->name('qualification-codes.histories');
                $router->get('qualification-codes/archives', 'QualificationCodesControllers@archives')
                    ->name('qualification-codes.archives');
                $router->put('qualification-codes/{qualification_code}/duplicate', 'QualificationCodesControllers@duplicate')
                    ->name('qualification-codes.duplicate');
                $router->resource('qualification-codes', 'QualificationCodesController');

                $router->put('qualification-types/{qualification_type}/restore', 'QualificationTypesControllers@restore')
                    ->name('qualification-types.restore');
                $router->get('qualification-types/{qualification_type}/revisions', 'QualificationTypesControllers@revisions')
                    ->name('qualification-types.revisions');
                $router->get('qualification-types/{qualification_type}/histories', 'QualificationTypesControllers@histories')
                    ->name('qualification-types.histories');
                $router->get('qualification-types/archives', 'QualificationTypesControllers@archives')
                    ->name('qualification-types.archives');
                $router->put('qualification-types/{qualification_type}/duplicate', 'QualificationTypesControllers@duplicate')
                    ->name('qualification-types.duplicate');
                $router->resource('qualification-types', 'QualificationTypesController');
            });
        });
    }
}
