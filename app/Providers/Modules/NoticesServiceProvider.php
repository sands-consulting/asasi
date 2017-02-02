<?php

namespace App\Providers\Modules;

use Illuminate\Support\ServiceProvider;

class NoticesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app('policy')->register('App\Http\Controllers\NoticesController', 'App\Policies\Admin\NoticePolicy');

        app('policy')->register('App\Http\Controllers\Admin\NoticesController', 'App\Policies\Admin\NoticePolicy');

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

                $router->get('notices/{notice}/events', [
                    'as'    => 'notices.events',
                    'uses'  => 'NoticesController@events'
                ]);
                $router->get('notices/{notice}/qualification-codes', [
                    'as'    => 'notices.qualification-codes',
                    'uses'  => 'NoticesController@qualificationCodes'
                ]);
                $router->get('notices/{notice}/files', [
                    'as'    => 'notices.files',
                    'uses'  => 'NoticesController@files'
                ]);
                $router->get('notices/{notice}/settings', [
                    'as'    => 'notices.settings',
                    'uses'  => 'NoticesController@settings'
                ]);

                $router->get('notices/{notice}/purchases', [
                    'as'    => 'notices.purchases',
                    'uses'  => 'NoticesController@purchases'
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
            });

            $router->get('notices/my-notices', [
                'as' => 'notices.my-notices',
                'uses' => 'NoticesController@myNotices'
            ]);
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
