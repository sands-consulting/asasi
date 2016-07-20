<?php

namespace App\Providers\Asasi;

use Illuminate\Support\ServiceProvider;
use Sands\Asasi\Booted\BootedTrait;
use App\UserLog;

class UserLogsProvider extends ServiceProvider
{
    use BootedTrait;

    protected $controller = 'App\Http\Controllers\UserLogsController';

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
        app('policy')->register($this->controller, 'App\Policies\UserLogsPolicy');

        // module routing
        app('router')->group(['namespace' => 'App\Http\Controllers', 'prefix' => 'admin'], function ($router) {
            $router->bind('user_logs', function ($slug) {
                if (!$UserLog = (UserLog::whereSlug($slug)->first() ?: UserLog::find($slug))) {
                    app()->abort(404);
                }
                return $UserLog;
            });
            $router->get('user-logs/data', 'UserLogsController@data');
            $router->get('user-logs/{user_logs}/duplicate', 'UserLogsController@duplicate');
            $router->get('user-logs/{user_logs}/delete', 'UserLogsController@delete');
            $router->get('user-logs/{user_logs}/revisions', 'UserLogsController@revisions');
            $router->resource('user-logs', 'UserLogsController');
        });
    }

    public function booted()
    {
        // 
    }
}
