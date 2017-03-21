<?php

namespace App\Providers\Asasi;

use App\User;
use Gate;
use Illuminate\Support\ServiceProvider;

class UsersServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::policy('App\User', 'App\Policies\Asasi\UserPolicy');
        Gate::policy('App\UserBlacklist', 'App\Policies\Asasi\UserBlacklistPolicy');

        app('policy')->register('App\Http\Controllers\UsersController', 'App\Policies\UserPolicy');
        app('policy')->register('App\Http\Controllers\MeController', 'App\Policies\MePolicy');

        app('policy')->register('App\Http\Controllers\Admin\UsersController', 'App\Policies\UserPolicy');
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
                $router->resource('users', 'UsersController');
                $router->resource('users.blacklists', 'UserBlacklistsController');
                $router->get('users/{user}/histories', 'UsersController@histories')
                    ->name('users.histories');
                $router->get('users/{user}/revisions', 'UsersController@revisions')
                    ->name('users.revisions');
                $router->post('users/{user}/assume', 'UsersController@assume')
                    ->name('users.assume');
                $router->put('users/{user}/activate', 'UsersController@activate')
                    ->name('users.activate');
                $router->put('users/{user}/suspend', 'UsersController@suspend')
                    ->name('users.suspend');
                $router->put('users/{user}/restore', 'UsersController@restore')
                    ->name('users.restore');
                $router->get('users/archives', 'UsersController@archives')
                    ->name('users.archives');
            });

            $router->get('me', 'MeController@edit')
                ->name('me');
            $router->put('me', 'MeController@update');
            $router->post('me/resume', 'MeController@resume')
                ->name('me.resume');
            $router->get('me/bookmarks', 'MeController@bookmarks')
                ->name('me.bookmarks');
        });
    }
}
