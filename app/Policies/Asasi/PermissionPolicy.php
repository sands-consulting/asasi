<?php

namespace App\Policies;

use App\User;
use App\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class PermissionPolicy
 * @package App\Policies
 */
class PermissionPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $auth
     * @return bool
     */
    public function index(User $auth)
    {
        return $auth->hasPermission('permission:index');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function show(User $auth)
    {
        return $auth->hasPermission('permission:show');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function create(User $auth)
    {
        return $auth->hasPermission('permission:create');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function store(User $auth)
    {
        return $this->create($auth);
    }

    /**
     * @param User $auth
     * @param Permission $permission
     * @return bool
     */
    public function edit(User $auth, Permission $permission)
    {
        return $auth->hasPermission('permission:update');
    }

    /**
     * @param User $auth
     * @param Permission $permission
     * @return bool
     */
    public function update(User $auth, Permission $permission)
    {
        return $this->edit($permission);
    }

    /**
     * @param User $auth
     * @param Permission $permission
     * @return bool
     */
    public function destroy(User $auth, Permission $permission)
    {
        return $auth->hasPermission('permission:delete');
    }

    /**
     * @param User $auth
     * @param Permission $permission
     * @return bool
     */
    public function restore(User $auth, Permission $permission)
    {
        return $auth->hasPermission('permission:restore');
    }

    /**
     * @param User $auth
     * @param Permission $permission
     * @return bool
     */
    public function revisions(User $auth, Permission $permission)
    {
        return $auth->hasPermission('permission:revisions');
    }

    /**
     * @param User $auth
     * @param Permission $permission
     * @return bool
     */
    public function histories(User $auth, Permission $permission)
    {
        return $auth->hasPermission('permission:histories');
    }

    /**
     * @param User $auth
     * @param Permission $permission
     * @return bool
     */
    public function archives(User $auth, Permission $permission)
    {
        return $auth->hasPermission('permission:archives');
    }

    /**
     * @param User $auth
     * @param Permission $permission
     * @return bool
     */
    public function duplicate(User $auth, Permission $permission)
    {
        return $auth->hasPermission('permission:duplicate');
    }
}
