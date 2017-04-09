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
        Gate::policy('App\TaxCode', 'App\Policies\Asasi\TaxCodePolicy');
        Gate::policy('App\Transaction', 'App\Policies\Asasi\TransactionPolicy');

        app('policy')->register('App\Http\Controllers\Admin\PaymentGatewaysController', 'App\Policies\Asasi\PaymentGatewayPolicy');
        app('policy')->register('App\Http\Controllers\Admin\TaxCodesController', 'App\Policies\Asasi\TaxCodePolicy');
        app('policy')->register('App\Http\Controllers\Admin\TransactionsController', 'App\Policies\Asasi\TransactionPolicy');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
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

                // Payment Gateway
                $router->put('payment-gateways/{payment_gateway}/restore', 'PaymentGatewaysController@restore')
                    ->name('payment-gateways.restore');
                $router->get('payment-gateways/{payment_gateway}/revisions', 'PaymentGatewaysController@revisions')
                    ->name('payment-gateways.revisions');
                $router->get('payment-gateways/{payment_gateway}/histories', 'PaymentGatewaysController@histories')
                    ->name('payment-gateways.histories');
                $router->get('payment-gateways/archives', 'PaymentGatewaysController@archives')
                    ->name('payment-gateways.archives');
                $router->put('payment-gateways/{payment_gateway}/duplicate', 'PaymentGatewaysController@duplicate')
                    ->name('payment-gateways.duplicate');

                $router->resource('payment-gateways', 'PaymentGatewaysController');

                // Tax Code
                $router->put('tax-codes/{tax_code}/restore', 'TaxCodesController@restore')
                    ->name('payment-gateways.restore');
                $router->get('tax-codes/{tax_code}/revisions', 'TaxCodesController@revisions')
                    ->name('payment-gateways.revisions');
                $router->get('tax-codes/{tax_code}/histories', 'TaxCodesController@histories')
                    ->name('payment-gateways.histories');
                $router->get('tax-codes/archives', 'TaxCodesController@archives')
                    ->name('payment-gateways.archives');
                $router->put('tax-codes/{tax_code}/duplicate', 'TaxCodesController@duplicate')
                    ->name('payment-gateways.duplicate');

                $router->resource('tax-codes', 'TaxCodesController');
            });

            $router->resource('transactions', 'TransactionsController', [
                'only' => ['index', 'show']]);
        });
    }
}
