<?php

namespace App\Providers\Asasi;

use App\User;
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
        app('policy')->register('App\Http\Controllers\ProfileController', 'App\Policies\ProfilePolicy');
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
            $router->bind('users', function($id) {    
                return User::withTrashed()->find($id);
            });

            $router->group(['namespace' => 'Admin', 'prefix' => 'admin'], function ($router) {
                $router->get('users/archives', [
                    'as'    => 'admin.users.archives',
                    'uses'  => 'UsersController@archives'
                ]);
                $router->put('users/{users}/restore', [
                    'as'    => 'admin.users.restore',
                    'uses'  => 'UsersController@restore'
                ]);
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

            $router->get('profile', [
                'as'    => 'profile',
                'uses'  => 'ProfileController@show'
            ]);
            $router->get('profile/edit', [
                'as'    => 'profile.edit',
                'uses'  => 'ProfileController@edit'
            ]);
            $router->put('profile', 'ProfileController@update');
            $router->post('profile/resume', [
                'as'    => 'profile.resume',
                'uses'  => 'ProfileController@resume'
            ]);
            $router->get('confirmation/{token}', 'Auth\AuthController@confirmation');
        });
    }
}
