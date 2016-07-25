<?php

namespace App\Providers\Asasi;

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
        app('policy')->register('App\Http\Controllers\Admin\UsersController', 'App\Policies\UsersPolicy');
        app('policy')->register('App\Http\Controllers\AccountController', 'App\Policies\AccountPolicy');
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
            $router->model('users', 'App\User');

            $router->group(['namespace' => 'Admin', 'prefix' => 'admin'], function ($router) {
                $router->get('users/{users}/logs', [
                    'as'    => 'admin.users.logs',
                    'uses'  => 'UsersController@logs'
                ]);
                $router->get('users/{users}/revisions', [
                    'as'    => 'admin.users.revisions',
                    'uses'  => 'UsersController@revisions'
                ]);
                $router->post('users/{users}/assume', [
                    'as'    => 'admin.users.assume',
                    'uses'  => 'UsersController@assume',
                ]);
                $router->put('users/{users}/activate', [
                    'as'    => 'admin.users.activate',
                    'uses'  => 'UsersController@activate',
                ]);
                $router->put('users/{users}/suspend', [
                    'as'    => 'admin.users.suspend',
                    'uses'  => 'UsersController@suspend',
                ]);
                $router->post('users/{users}/duplicate', [
                    'as'    => 'admin.users.duplicate',
                    'uses'  => 'UsersController@duplicate'
                ]);
                $router->resource('users', 'UsersController');
            });

            $router->get('account', [
                'as'    => 'account',
                'uses'  => 'AccountController@show'
            ]);
            $router->get('account/edit', [
                'as'    => 'account.edit',
                'uses'  => 'AccountController@edit'
            ]);
            $router->put('account', 'AccountController@update');
            $router->post('account/resume', [
                'as'    => 'account.resume',
                'uses'  => 'AccountController@resume'
            ]);
        });
    }
}
