<?php

namespace App\Traits;

trait Roleable
{
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /*
     * ACL functions
     */

    public function hasRole($role)
    {
        return $this->roles()->whereName($role)->count() == 1;
    }

    public function hasRoles($roles)
    {
        return $this->roles()->whereName($roles)->count() > 0;
    }

    public function hasPermission($permission)
    {
        return in_array($permission, $this->cachedPermissions());
    }

    public function hasPermissions($permissions = [])
    {
        return count(array_intersect($this->cachedPermissions(), $permissions)) > 0;
    }

    public function hasAllPermissions($permissions = [])
    {
        return count(array_intersect($this->cachedPermissions(), $permissions)) == count($permissions);
    }

    /*
     * Permissions caching
     */

    public function cachePermissions()
    {
        if (Cache::has($this->permissions_cache_key)) {
            Cache::forget($this->permissions_cache_key);
        }

        $that = $this;
        Cache::rememberForever($this->permissions_cache_key, function () use ($that) {
            return Permission::join('permission_role', 'permission_role.permission_id', '=', 'permissions.id')
                                        ->whereIn('permission_role.role_id', $that->roles->lists('id')->toArray())
                                        ->lists('name')
                                        ->toArray();
        });
    }

    protected function getPermissionsCacheKeyAttribute()
    {
        return 'user.permissions.' . $this->getKey();
    }
}