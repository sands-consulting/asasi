<?php

namespace App\Providers\Modules;

use Illuminate\Support\ServiceProvider;

class NoticesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app('policy')->register('App\Http\Controllers\Admin\NoticesController', 'App\Policies\Admin\NoticesPolicy');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // module routing
        app('router')->group([
            'middleware' => 'web',
            'namespace' => 'App\Http\Controllers'
        ], function ($router) {
            $router->model('evaluation_types', 'App\EvaluationType');

            $router->group(['namespace' => 'Admin', 'prefix' => 'admin'], function ($router) {
                $router->put('notices/{notices}/publish', [
                    'as'    => 'admin.notices.publish',
                    'uses'  => 'NoticesController@publish'
                ]);
                $router->put('notices/{notices}/unpublish', [
                    'as'    => 'admin.notices.unpublish',
                    'uses'  => 'NoticesController@unpublish'
                ]);
                $router->put('notices/{notices}/cancel', [
                    'as'    => 'admin.notices.cancel',
                    'uses'  => 'NoticesController@cancel'
                ]);
                $router->get('notices/{notices}/logs', [
                    'as'    => 'admin.notices.logs',
                    'uses'  => 'NoticesController@logs'
                ]);
                $router->get('notices/{notices}/revisions', [
                    'as'    => 'admin.notices.revisions',
                    'uses'  => 'NoticesController@revisions'
                ]);
                $router->post('notices/{notices}/duplicate', [
                    'as'    => 'admin.notices.duplicate',
                    'uses'  => 'NoticesController@duplicate'
                ]);

                $router->get('notices/{notices}/events', [
                    'as'    => 'admin.notices.events',
                    'uses'  => 'NoticesController@events'
                ]);
                $router->get('notices/{notices}/settings', [
                    'as'    => 'admin.notices.settings',
                    'uses'  => 'NoticesController@settings'
                ]);
                $router->get('notices/{notices}/qualification-codes', [
                    'as'    => 'admin.notices.qualification-codes',
                    'uses'  => 'NoticesController@qualificationCodes'
                ]);
                 $router->get('notices/{notices}/files', [
                    'as'    => 'admin.notices.files',
                    'uses'  => 'NoticesController@files'
                ]);
                $router->get('notices/{notices}/purchases', [
                    'as'    => 'admin.notices.purchases',
                    'uses'  => 'NoticesController@purchases'
                ]);
                

                $router->post('notices/{notices}/award/{vendors}', [
                    'as' => 'admin.notices.award',
                    'uses' => 'NoticesController@award'
                ]);
                $router->post('notices/{notices}/store-award', [
                    'as' => 'admin.notices.store-award',
                    'uses' => 'NoticesController@storeAward'  
                ]);
                // Summary
                $router->get('notices/{notices}/summary', [
                    'as' => 'admin.notices.summary',
                    'uses' => 'NoticesController@summary'
                ]);
                $router->get('notices/{notices}/summary/{evaluation_types}', [
                    'as' => 'admin.notices.summary-by-type',
                    'uses' => 'NoticesController@summaryByType'
                ]);
                $router->get('notices/{notices}/summary/{submissions}/evaluators/{evaluation_types}', [
                    'as' => 'admin.notices.summary-evaluators',
                    'uses' => 'NoticesController@summaryEvaluators'
                ]);

                $router->resource('notices', 'NoticesController');
            });

            $router->get('notices/my-notices', [
                'as' => 'notices.my-notices',
                'uses' => 'NoticesController@myNotices'
            ]);
            $router->get('notices/{notices}/submission/', [
                'as' => 'notices.submission',
                'uses' => 'NoticesController@submission'
            ]);
            $router->post('notices/{notices}/commercial/', [
                'as' => 'notices.commercial',
                'uses' => 'NoticesController@commercial'
            ]);
            $router->post('notices/{notices}/commercial-edit/{submissions}', [
                'as' => 'notices.commercial-edit',
                'uses' => 'NoticesController@commercialEdit'
            ]);
            $router->post('notices/{notices}/technical/', [
                'as' => 'notices.technical',
                'uses' => 'NoticesController@technical'
            ]);
            $router->post('notices/{notices}/technical-edit/{submissions}', [
                'as' => 'notices.technical-edit',
                'uses' => 'NoticesController@technicalEdit'
            ]);
            $router->post('notices/{notices}/save-submission/', [
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

            $router->put('notices/{notices}/update', [
                'as' => 'api.notices.update',
                'uses' => 'NoticesController@update'
            ]);
        });
    }
}
