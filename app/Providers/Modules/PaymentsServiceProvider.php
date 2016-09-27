<?php

namespace App\Providers\Modules;

use Illuminate\Support\ServiceProvider;

class PaymentsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app('policy')->register('App\Http\Controllers\Admin\PaymentsController', 'App\Policies\PaymentsPolicy');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // module routing
        app('router')->group(['namespace' => 'App\Http\Controllers'], function ($router) {
            $router->model('payments', 'App\Payment');

            $router->group(['namespace' => 'Admin', 'prefix' => 'admin'], function ($router) {
                $router->put('payments/{payments}/activate', [
                    'as'    => 'admin.payments.activate',
                    'uses'  => 'PaymentsController@activate'
                ]);
                $router->put('payments/{payments}/deactivate', [
                    'as'    => 'admin.payments.deactivate',
                    'uses'  => 'PaymentsController@deactivate'
                ]);
                $router->get('payments/{payments}/logs', [
                    'as'    => 'admin.payments.logs',
                    'uses'  => 'PaymentsController@logs'
                ]);
                $router->get('payments/{payments}/revisions', [
                    'as'    => 'admin.payments.revisions',
                    'uses'  => 'PaymentsController@revisions'
                ]);
                $router->post('payments/{payments}/duplicate', [
                    'as'    => 'admin.payments.duplicate',
                    'uses'  => 'PaymentsController@duplicate'
                ]);
                $router->resource('payments', 'PaymentsController');
            });

            $router->post('payments/endpoint', [
                'as'    => 'payments.endpoint',
                'uses'  => 'PaymentsController@endpoint'
            ]);

            $router->get('payments/redirect', [
                'as'    => 'payments.redirect',
                'uses'  => 'PaymentsController@redirect'
            ]);

            $router->get('payments/summary', [
                'as'    => 'payments.summary',
                'uses'  => 'PaymentsController@summary'
            ]);

            $router->get('payments/invoice', [
                'as'    => 'payments.invoice',
                'uses'  => 'PaymentsController@invoice'
            ]);

            $router->get('payments/receipt', [
                'as'    => 'payments.receipt',
                'uses'  => 'PaymentsController@receipt'
            ]);

            $router->get('payments/invoice/print', [
                'as'    => 'payments.invoice',
                'uses'  => 'PaymentsController@printInvoice'
            ]);

            $router->get('payments/receipt/print', [
                'as'    => 'payments.receipt',
                'uses'  => 'PaymentsController@printReceipt'
            ]);

            $router->resource('payments', 'PaymentsController');
        });
    }
}
