<?php

namespace App\Providers\Asasi;

use Illuminate\Support\ServiceProvider;
use Sands\Asasi\Booted\BootedTrait;
use App\PermissionGroup;

class PermissionGroupsProvider extends ServiceProvider
{
    use BootedTrait;

    protected $controller = 'App\Http\Controllers\PermissionGroupsController';

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
        app('policy')->register($this->controller, 'App\Policies\PermissionGroupsPolicy');

        // module routing
        app('router')->group(['namespace' => 'App\Http\Controllers', 'prefix' => 'admin'], function ($router) {
            $router->bind('permission_groups', function ($slug) {
                if (!$permissionGroup = (PermissionGroup::whereSlug($slug)->first() ?: PermissionGroup::find($slug))) {
                    app()->abort(404);
                }
                return $permissionGroup;
            });
            $router->get('permission-groups/data', 'PermissionGroupsController@data');
            $router->get('permission-groups/{permission_groups}/duplicate', 'PermissionGroupsController@duplicate');
            $router->get('permission-groups/{permission_groups}/delete', 'PermissionGroupsController@delete');
            $router->get('permission-groups/{permission_groups}/revisions', 'PermissionGroupsController@revisions');
            $router->resource('permission-groups', 'PermissionGroupsController');
        });
    }

    public function booted()
    {
        // register menus
        app('menu')->register($this->controller, 'App\Menus\PermissionGroupsMenu');
    }
}
