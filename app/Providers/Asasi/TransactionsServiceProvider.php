<?php

namespace App\Providers\Asasi;

use App\Organization;
use Gate;
use Illuminate\Support\ServiceProvider;

class TransactionsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::policy('App\PaymentGateway', 'App\Policies\Asasi\PaymentGatewayPolicy');
        Gate::policy('App\Transaction', 'App\Policies\Asasi\TransactionPolicy');

        app('policy')->register('App\Http\Controllers\Admin\PaymentGatewaysController', 'App\Policies\PaymentGatewayPolicy');
        app('policy')->register('App\Http\Controllers\Admin\TransactionsController', 'App\Policies\TransactionPolicy');
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
            'namespace' => 'App\Http\Controllers',
            'middleware' => 'web'
        ], function ($router) {
            $router->group([
                'namespace' => 'Admin',
                'prefix' => 'admin',
                'as' => 'admin.'
            ], function ($router) {
                $router->put('transactions/{transaction}/restore', 'TransactionsController@restore')
                    ->name('transactions.restore');
                $router->get('transactions/{transaction}/revisions', 'TransactionsController@revisions')
                    ->name('transactions.revisions');
                $router->get('transactions/{transaction}/histories', 'TransactionsController@histories')
                    ->name('transactions.histories');
                $router->get('transactions/archives', 'TransactionsController@archives')
                    ->name('transactions.archives');
                $router->put('transactions/{transaction}/duplicate', 'TransactionsController@duplicate')
                    ->name('transactions.duplicate');

                $router->get('transactions/{transaction}/paid', 'TransactionsController@paid')
                    ->name('transactions.paid');
                $router->get('transactions/{transaction}/cancel', 'TransactionsController@cancel')
                    ->name('transactions.cancel');
                $router->get('transactions/{transaction}/refund', 'TransactionsController@refund')
                    ->name('transactions.refund');
                $router->get('transactions/{transaction}/query', 'TransactionsController@query')
                    ->name('transactions.query');

                $router->resource('transactions', 'TransactionsController');

                $router->put('transactions/{payment_gateway}/restore', 'PaymentGatewaysController@restore')
                    ->name('payment-gateways.restore');
                $router->get('transactions/{payment_gateway}/revisions', 'PaymentGatewaysController@revisions')
                    ->name('payment-gateways.revisions');
                $router->get('transactions/{payment_gateway}/histories', 'PaymentGatewaysController@histories')
                    ->name('payment-gateways.histories');
                $router->get('transactions/archives', 'PaymentGatewaysController@archives')
                    ->name('payment-gateways.archives');
                $router->put('transactions/{payment_gateway}/duplicate', 'PaymentGatewaysController@duplicate')
                    ->name('payment-gateways.duplicate');

                $router->resource('payment-gateways', 'PaymentGatewaysController');
            });
        });
    }
}
