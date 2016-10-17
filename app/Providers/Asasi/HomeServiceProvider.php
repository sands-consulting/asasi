<?php

namespace App\Providers\Asasi;

use Illuminate\Support\ServiceProvider;

class HomeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        app('router')->group(['namespace' => 'App\Http\Controllers'], function ($router) {
            $router->get('/', [
                'as'    => 'home',
                'uses'  => 'HomeController@index'
            ]);
            $router->get('submissions', [
                'as'    => 'submissions',
                'uses'  => 'HomeController@submissions'
            ]);
            $router->get('awards', [
                'as'    => 'awards',
                'uses'  => 'HomeController@awards'
            ]);
            $router->get('contact', [
                'as'    => 'contact',
                'uses'  => 'HomeController@contact'
            ]);
        });
    }
}
