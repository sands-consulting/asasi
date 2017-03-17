<?php

namespace App\Providers\Modules;

use Gate;
use Illuminate\Support\ServiceProvider;

class NoticesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::policy("App\Notice", "App\Policies\NoticePolicy");
        app('policy')->register('App\Http\Controllers\Admin\NoticesController', 'App\Policies\NoticePolicy');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
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
                $router->put('notices/{notice}/publish', [
                    'as'    => 'notices.publish',
                    'uses'  => 'NoticesController@publish'
                ]);
                $router->put('notices/{notice}/unpublish', [
                    'as'    => 'notices.unpublish',
                    'uses'  => 'NoticesController@unpublish'
                ]);
                $router->put('notices/{notice}/cancel', [
                    'as'    => 'notices.cancel',
                    'uses'  => 'NoticesController@cancel'
                ]);
                $router->get('notices/{notice}/histories', [
                    'as'    => 'notices.histories',
                    'uses'  => 'NoticesController@histories'
                ]);
                $router->get('notices/{notice}/revisions', [
                    'as'    => 'notices.revisions',
                    'uses'  => 'NoticesController@revisions'
                ]);
                $router->post('notices/{notice}/duplicate', [
                    'as'    => 'notices.duplicate',
                    'uses'  => 'NoticesController@duplicate'
                ]);                

                $router->post('notices/{notice}/award/{vendors}', [
                    'as' => 'notices.award',
                    'uses' => 'NoticesController@award'
                ]);
                $router->post('notices/{notice}/store-award', [
                    'as' => 'notices.store-award',
                    'uses' => 'NoticesController@storeAward'  
                ]);

                // Summary
                $router->get('notices/{notice}/summary', [
                    'as' => 'notices.summary',
                    'uses' => 'NoticesController@summary'
                ]);
                $router->get('notices/{notice}/summary/{evaluation_types}', [
                    'as' => 'notices.summary-by-type',
                    'uses' => 'NoticesController@summaryByType'
                ]);
                $router->get('notices/{notice}/summary/{submissions}/evaluators/{evaluation_types}', [
                    'as' => 'notices.summary-evaluators',
                    'uses' => 'NoticesController@summaryEvaluators'
                ]);

                $router->resource('notices', 'NoticesController');

                $router->put('notice-categories/{notice_category}/activate', [
                    'as'    => 'admin.notice-categories.activate',
                    'uses'  => 'NoticeCategoriesController@activate'
                ]);
                $router->put('notice-categories/{notice_category}/deactivate', [
                    'as'    => 'admin.notice-categories.deactivate',
                    'uses'  => 'NoticeCategoriesController@deactivate'
                ]);
                $router->get('notice-categories/{notice_category}/histories', [
                    'as'    => 'admin.notice-categories.histories',
                    'uses'  => 'NoticeCategoriesController@histories'
                ]);
                $router->get('notice-categories/{notice_category}/revisions', [
                    'as'    => 'admin.notice-categories.revisions',
                    'uses'  => 'NoticeCategoriesController@revisions'
                ]);
                $router->post('notice-categories/{notice_category}/duplicate', [
                    'as'    => 'admin.notice-categories.duplicate',
                    'uses'  => 'NoticeCategoriesController@duplicate'
                ]);
                $router->resource('notice-categories', 'NoticeCategoriesController');

                 $router->put('notice-types/{notice_type}/activate', [
                    'as'    => 'notice-types.activate',
                    'uses'  => 'NoticeTypesController@activate'
                ]);
                $router->put('notice-types/{notice_type}/deactivate', [
                    'as'    => 'notice-types.deactivate',
                    'uses'  => 'NoticeTypesController@deactivate'
                ]);
                $router->get('notice-types/{notice_type}/histories', [
                    'as'    => 'notice-types.histories',
                    'uses'  => 'NoticeTypesController@histories'
                ]);
                $router->get('notice-types/{notice_type}/revisions', [
                    'as'    => 'notice-types.revisions',
                    'uses'  => 'NoticeTypesController@revisions'
                ]);
                $router->post('notice-types/{notice_type}/duplicate', [
                    'as'    => 'notice-types.duplicate',
                    'uses'  => 'NoticeTypesController@duplicate'
                ]);
                $router->resource('notice-types', 'NoticeTypesController');
            });

            $router->get('notices/{notice}/submission/', [
                'as' => 'notices.submission',
                'uses' => 'NoticesController@submission'
            ]);
            $router->post('notices/{notice}/commercial/', [
                'as' => 'notices.commercial',
                'uses' => 'NoticesController@commercial'
            ]);
            $router->post('notices/{notice}/commercial-edit/{submissions}', [
                'as' => 'notices.commercial-edit',
                'uses' => 'NoticesController@commercialEdit'
            ]);
            $router->post('notices/{notice}/technical/', [
                'as' => 'notices.technical',
                'uses' => 'NoticesController@technical'
            ]);
            $router->post('notices/{notice}/technical-edit/{submissions}', [
                'as' => 'notices.technical-edit',
                'uses' => 'NoticesController@technicalEdit'
            ]);
            $router->post('notices/{notice}/save-submission/', [
                'as' => 'notices.save-submission',
                'uses' => 'NoticesController@saveSubmission'
            ]);
            $router->post('notices/submission-submit/{submissions}', [
                'as' => 'notices.submission-submit',
                'uses' => 'NoticesController@submissionSubmit'
            ]);
            $router->get('notices/submission-slip/{submissions}', [
                'as' => 'notices.submission-slip',
                'uses' => 'NoticesController@submissionSlip'
            ]);
            $router->resource('notices', 'NoticesController', ['only' => ['index', 'show']]);
        });

        // api routing
        app('router')->group(['namespace' => 'App\Http\Controllers\Api', 'prefix' => 'api'], function ($router) {
            $router->post('notices/save', [
                'as' => 'api.notices.save',
                'uses' => 'NoticesController@save'
            ]);

            $router->put('notices/{notice}/update', [
                'as' => 'api.notices.update',
                'uses' => 'NoticesController@update'
            ]);
        });
    }
}
