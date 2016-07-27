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
            ->register('App\Http\Controllers\Admin\QualificationCodeTypesController', 'App\Policies\QualificationCodeTypesPolicy');
    }

    public function register()
    {
        app('router')->group(['namespace' => 'App\Http\Controllers'], function ($router) {
            $router->model('qualification_codes', 'App\QualificationCode');
            $router->model('qualification_code_types', 'App\QualificationCodeType');

            $router->group(['namespace' => 'Admin', 'prefix' => 'admin'], function ($router) {
                $router->get('qualification-codes/{qualification_codes}/revisions', [
                    'as'    => 'admin.qualification-codes.revisions',
                    'uses'  => 'QualificationCodesController@revisions'
                ]);
                $router->get('qualification-codes/{qualification_codes}/publish', [
                    'as'    => 'admin.qualification-codes.publish',
                    'uses'  => 'QualificationCodesController@publish'
                ]);
                $router->get('qualification-codes/{qualification_codes}/unpublish', [
                    'as'    => 'admin.qualification-codes.unpublish',
                    'uses'  => 'QualificationCodesController@unpublish'
                ]);
                $router->resource('qualification-codes', 'QualificationCodesController');

                $router->get('qualification-code-types/{qualification_code_types}/revisions', [
                    'as'    => 'admin.qualification-code-types.revisions',
                    'uses'  => 'QualificationCodeTypesController@revisions'
                ]);
                $router->get('qualification-code-types/{qualification_code_types}/publish', [
                    'as'    => 'admin.qualification-code-types.publish',
                    'uses'  => 'QualificationCodeTypesController@publish'
                ]);
                $router->get('qualification-code-types/{qualification_code_types}/unpublish', [
                    'as'    => 'admin.qualification-code-types.unpublish',
                    'uses'  => 'QualificationCodeTypesController@unpublish'
                ]);
                $router->resource('qualification-code-types', 'QualificationCodeTypesController');
            });
        });
    }
}
