<?php

namespace App\Providers\Asasi;

use Illuminate\Support\ServiceProvider;
use Sands\Asasi\Booted\BootedTrait;
use App\Permission;

class PermissionsProvider extends ServiceProvider
{
    use BootedTrait;

    protected $controller = 'App\Http\Controllers\PermissionsController';

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
        app('policy')->register($this->controller, 'App\Policies\PermissionPolicy');

        // module routing
        app('router')->group(['namespace' => 'App\Http\Controllers', 'prefix' => 'admin'], function ($router) {
            $router->bind('permissions', function ($slug) {
                if (!$permission = (Permission::whereSlug($slug)->first() ?: Permission::find($slug))) {
                    app()->abort(404);
                }
                return $permission;
            });
            $router->get('permissions/data', 'PermissionsController@data');
            $router->get('permissions/{permissions}/duplicate', 'PermissionsController@duplicate');
            $router->get('permissions/{permissions}/delete', 'PermissionsController@delete');
            $router->get('permissions/{permissions}/revisions', 'PermissionsController@revisions');
            $router->resource('permissions', 'PermissionsController');
        });
    }

    public function booted()
    {
        //
    }
}
