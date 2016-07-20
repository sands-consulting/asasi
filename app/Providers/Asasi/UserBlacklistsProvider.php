<?php

namespace App\Providers\Asasi;

use Illuminate\Support\ServiceProvider;
use Sands\Asasi\Booted\BootedTrait;
use App\UserBlacklist;

class UserBlacklistsProvider extends ServiceProvider
{
    use BootedTrait;

    protected $controller = 'App\Http\Controllers\UserBlacklistsController';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootBootedTrait();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        // register policies
        app('policy')->register($this->controller, 'App\Policies\UserBlacklistsPolicy');

        // module routing
        app('router')->group(['namespace' => 'App\Http\Controllers', 'prefix' => 'admin'], function ($router) {
            $router->bind('user_blacklists', function ($slug) {
                if (!$userBlacklist = (UserBlacklist::whereSlug($slug)->first() ?: UserBlacklist::find($slug))) {
                    app()->abort(404);
                }
                return $userBlacklist;
            });
            $router->get('user/{users}/user_blacklists/data', 'UserBlacklistsController@data');
            $router->get('user/{users}/user_blacklists/{user_blacklists}/duplicate', 'UserBlacklistsController@duplicate');
            $router->get('user/{users}/user_blacklists/{user_blacklists}/delete', 'UserBlacklistsController@delete');
            $router->get('user/{users}/user_blacklists/{user_blacklists}/revisions', 'UserBlacklistsController@revisions');
            $router->resource('user/{users}/user_blacklists', 'UserBlacklistsController');
        });
    }

    public function booted()
    {
        //
    }
}
