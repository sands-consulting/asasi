<?php

namespace App\Providers\Modules;

use App\NoticeCategory;
use App\NoticeType;
use Gate;
use Illuminate\Support\ServiceProvider;

class NoticesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::policy('App\Notice', 'App\Policies\NoticePolicy');
        Gate::policy('App\NoticeCategory', 'App\Policies\NoticeCategoryPolicy');
        Gate::policy('App\NoticeType', 'App\Policies\NoticeTypePolicy');

        app('policy')->register('App\Http\Controllers\Admin\NoticesController', 'App\Policies\NoticePolicy');
        app('policy')->register('App\Http\Controllers\Admin\NoticeCategoriesController', 'App\Policies\NoticeCategoryPolicy');
        app('policy')->register('App\Http\Controllers\Admin\NoticeTypesController', 'App\Policies\NoticeTypePolicy');
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
                $router->put('notices/{notice}/restore', 'NoticesController@restore')
                    ->name('notices.restore');
                $router->get('notices/{notice}/revisions', 'NoticesController@revisions')
                    ->name('notices.revisions');
                $router->get('notices/{notice}/histories', 'NoticesController@histories')
                    ->name('notices.histories');
                $router->get('notices/archives', 'NoticesController@archives')
                    ->name('notices.archives');
                $router->put('notices/{notice}/duplicate', 'NoticesController@duplicate')
                    ->name('notices.duplicate');

                $router->put('notices/{notice}/publish', 'NoticesController@publish')
                    ->name('notices.publish');
                $router->put('notices/{notice}/unpublish', 'NoticesController@unpublish')
                    ->name('notices.unpublish');
                $router->put('notices/{notice}/cancel', 'NoticesController@cancel')
                    ->name('notices.cancel');
                
                $router->post('notices/{notice}/eligible', 'NoticesController@eligible')
                    ->name('notices.eligible');
                $router->post('notices/{notice}/invitation', 'NoticesController@invitation')
                    ->name('notices.invitation');
                $router->post('notices/{notice}/submissions', 'NoticesController@submissions')
                    ->name('notices.submissions');
                $router->post('notices/{notice}/award', 'NoticesController@award')
                    ->name('notices.award');

                $router->resource('notices', 'NoticesController');


                // Notice Category
                $router->model('notice_category', NoticeCategory::class);

                $router->put('notice-categories/{notice_category}/restore', 'NoticeCategoriesController@restore')
                    ->name('notice-categories.restore');
                $router->get('notice-categories/{notice_category}/revisions', 'NoticeCategoriesController@revisions')
                    ->name('notice-categories.revisions');
                $router->get('notice-categories/{notice_category}/histories', 'NoticeCategoriesController@histories')
                    ->name('notice-categories.histories');
                $router->get('notice-categories/archives', 'NoticeCategoriesController@archives')
                    ->name('notice-categories.archives');
                $router->put('notice-categories/{notice_category}/duplicate', 'NoticeCategoriesController@duplicate')
                    ->name('notice-categories.duplicate');

                $router->resource('notice-categories', 'NoticeCategoriesController');

                // Notice Type
                $router->model('notice_type', NoticeType::class);
                $router->put('notice-types/{notice_type}/restore', 'NoticeTypesController@restore')
                    ->name('notice-types.restore');
                $router->get('notice-types/{notice_type}/revisions', 'NoticeTypesController@revisions')
                    ->name('notice-types.revisions');
                $router->get('notice-types/{notice_type}/histories', 'NoticeTypesController@histories')
                    ->name('notice-types.histories');
                $router->get('notice-types/archives', 'NoticeTypesController@archives')
                    ->name('notice-types.archives');
                $router->put('notice-types/{notice_type}/duplicate', 'NoticeTypesController@duplicate')
                    ->name('notice-types.duplicate');

                $router->resource('notice-types', 'NoticeTypesController');
            });

            $router->resource('notices', 'NoticesController', ['only' => ['index', 'show']]);
            $router->post('notices/{notice}/bookmark', 'NoticesController@bookmark')
                ->name('notices.bookmark');
        });

        $api = app('Dingo\Api\Routing\Router');
        $api->version('v1', function($api) {
            $api->group([
                'middleware' => ['api.auth', 'bindings'],
            ], function($api) {
                $api->post('notices', 'App\Http\Controllers\Api\NoticesController@index')
                    ->name('api.notices.index');
                $api->get('eligibles', 'App\Http\Controllers\Api\NoticesController@eligibles')
                    ->name('api.notices.eligibles');
                $api->get('purchases', 'App\Http\Controllers\Api\NoticesController@purchases')
                    ->name('api.notices.purchases');
            });
        });

    }
}
