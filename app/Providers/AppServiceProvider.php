<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app('router')->group(['namespace' => 'App\Http\Controllers'], function ($router) {
            $router->group(['middleware' => 'auth'], function($router) {
                $router->get('/', 'MeController@edit')
                    ->name('root');
            });

            $router->auth();

            $router->get('set/{locale}', function($locale) {
                return redirect()->back()->withCookie(cookie()->forever('locale', $locale));
            });
        });
    }
}
