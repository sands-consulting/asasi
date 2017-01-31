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

            $router->get('contact', 'MeController@contact')
                ->name('contact');

            $router->auth();

            $router->get('/', 'NoticesController@index')
                ->name('root');
        });
    }
}
