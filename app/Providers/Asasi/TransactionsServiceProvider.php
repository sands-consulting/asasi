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
        Gate::policy('App\Transaction', 'App\Policies\Asasi\TransactionPolicy');

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
                $router->get('transactions/{transaction}/histories', 'TransactionsController@histories')
                    ->name('transactions.histories');
                $router->get('transactions/{transaction}/revisions', 'TransactionsController@revisions')
                    ->name('transactions.revisions');
                $router->get('transactions/{transaction}/paid', 'TransactionsController@histories')
                    ->name('transactions.histories');
                $router->get('transactions/{transaction}/cancel', 'TransactionsController@revisions')
                    ->name('transactions.revisions');
                $router->get('transactions/{transaction}/refund', 'TransactionsController@revisions')
                    ->name('transactions.revisions');
                $router->get('transactions/{transaction}/query', 'TransactionsController@revisions')
                    ->name('transactions.revisions');
                $router->get('transactions/archives', 'TransactionsController@archives')
                    ->name('transactions.archives');
                $router->resource('transactions', 'TransactionsController');
            });
        });
    }
}
