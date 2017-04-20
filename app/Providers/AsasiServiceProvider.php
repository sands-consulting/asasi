<?php

namespace App\Providers;

use Hash;
use Illuminate\Support\ServiceProvider;

class AsasiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->setLocale(request()->cookie('locale') ?: 'en');

        $this->app->validator->extend('hash', function ($attribute, $value, $parameters, $validator) {
            return Hash::check($value, $parameters[0]);
        });

        $this->app->validator->extend('without_spaces', function($attr, $value){
            return preg_match('/^\S*$/u', $value);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app('router')->group([
            'namespace' => 'App\Http\Controllers',
            'middleware' => 'web',
        ], function ($router) {
            $router->get('set/{locale}', function($locale) {
                return redirect()->back()->withCookie(cookie()->forever('locale', $locale));
            });

            $router->get('contact', 'ContactController@create')
                ->name('contact');
            $router->post('contact', 'ContactController@store');

            $router->auth();
            $router->get('confirmation/{token}', 'Auth\LoginController@confirmation')
                ->name('confirmation');

            $router->get('docs', function(){
                return view('docs.index');
            })->name('docs');

            $router->get('/', 'NoticesController@index')
                ->name('root');
        });

        $api = app('Dingo\Api\Routing\Router');
        $api->version('v1', function($api) {
            $api->post('me', 'App\Http\Controllers\Api\MeController@create');

            $api->group([
                'middleware' => ['api.auth', 'bindings'],
            ], function($api) {
                $api->get('me', 'App\Http\Controllers\Api\MeController@show');
            });
        });
    }
}
