<?php

namespace App\Providers\Asasi;

use App\User;
<<<<<<< HEAD
=======
use Gate;
>>>>>>> upstream/5.3
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
<<<<<<< HEAD
        app('policy')->register('App\Http\Controllers\Admin\UsersController', 'App\Policies\UsersPolicy');
        app('policy')->register('App\Http\Controllers\ProfileController', 'App\Policies\ProfilePolicy');
=======
        app('policy')->register('App\Http\Controllers\UsersController', 'App\Policies\UserPolicy');
        app('policy')->register('App\Http\Controllers\MeController', 'App\Policies\MePolicy');

        app('policy')->register('App\Http\Controllers\Admin\UsersController', 'App\Policies\UserPolicy');

        Gate::policy("App\User", "App\Policies\UserPolicy");
        Gate::policy("App\UserBlacklist", "App\Policies\UserBlacklistPolicy");
>>>>>>> upstream/5.3
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
<<<<<<< HEAD

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
=======
        // module routing
        app('router')->group(['namespace' => 'App\Http\Controllers', 'middleware' => 'auth'], function ($router) {
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
            });

            $router->get('me', 'MeController@edit')
                ->name('me');
            $router->put('me', 'MeController@update');
            $router->get('me/resume', 'MeController@resume')
                ->name('me.resume');
>>>>>>> upstream/5.3
        });
    }
}
