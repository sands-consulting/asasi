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

        app('policy')->register('App\Http\Controllers\UsersController', 'App\Policies\UserPolicy');
        app('policy')->register('App\Http\Controllers\MeController', 'App\Policies\MePolicy');

        app('policy')->register('App\Http\Controllers\Admin\UsersController', 'App\Policies\UserPolicy');

        Gate::policy("App\User", "App\Policies\UserPolicy");
        Gate::policy("App\UserBlacklist", "App\Policies\UserBlacklistPolicy");
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
            'middleware' => ['web', 'auth']
        ], function ($router) {
            $router->group(['prefix' => 'admin', 'namespace' => 'Admin'], function($router) {
                $router->resource('users', 'UsersController');
                $router->resource('users.blacklists', 'UserBlacklistsController');
                $router->put('users/{user}/activate', 'UsersController@activate')
                    ->name('admin.users.activate');
                $router->put('users/{user}/suspend', 'UsersController@suspend')
                    ->name('admin.users.suspend');
                $router->get('users/{user}/histories', 'UsersController@histories')
                    ->name('admin.users.histories');
                $router->get('users/{user}/revisions', 'UsersController@revisions')
                    ->name('admin.users.revisions');
                $router->get('users/{user}/assume', 'UsersController@assume')
                    ->name('admin.users.assume');
                $router->get('users/archives', 'UsersController@archives')
                    ->name('admin.users.archives');
                $router->put('users/{user}/restore', 'UsersController@restore')
                    ->name('admin.users.restore');
            });

            $router->get('me', 'MeController@edit')
                ->name('me');
            $router->put('me', 'MeController@update');
            $router->get('me/resume', 'MeController@resume')
                ->name('me.resume');
        });
    }
}
