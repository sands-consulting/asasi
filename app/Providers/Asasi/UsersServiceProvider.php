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
            'middleware' => 'web'
        ], function ($router) {
            $router->group([
                'namespace' => 'Admin',
                'prefix' => 'admin',
                'as' => 'admin.'
            ], function ($router) {
                $router->resource('users', 'UsersController');
                $router->resource('users.blacklists', 'UserBlacklistsController');
                $router->put('users/{user}/activate', 'UsersController@activate')
                    ->name('users.activate');
                $router->put('users/{user}/suspend', 'UsersController@suspend')
                    ->name('users.suspend');
                $router->get('users/{user}/histories', 'UsersController@histories')
                    ->name('users.histories');
                $router->get('users/{user}/revisions', 'UsersController@revisions')
                    ->name('users.revisions');
                $router->post('users/{user}/assume', 'UsersController@assume')
                    ->name('users.assume');
                $router->get('users/archives', 'UsersController@archives')
                    ->name('users.archives');
                $router->put('users/{user}/restore', 'UsersController@restore')
                    ->name('users.restore');
            });

            $router->get('me', 'MeController@edit')
                ->name('me');
            $router->put('me', 'MeController@update');
            $router->post('me/resume', 'MeController@resume')
                ->name('me.resume');
            $router->get('me/bookmarks', 'MeController@bookmarks')
                ->name('me.bookmarks');

            $router->resource('vendors.users', 'VendorUsersController');
            $router->get('confirmation/{token}', 'Auth\LoginController@confirmation')
                ->name('confirmation');
        });
    }
}
