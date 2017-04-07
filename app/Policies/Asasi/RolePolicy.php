<?php

namespace App\Policies\Asasi;

use App\User;
use App\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class RolePolicy
 * @package App\Policies
 */
class RolePolicy
{
    use HandlesAuthorization;

    /**
     * @param User $auth
     * @return bool
     */
    public function index(User $auth)
    {
        return $auth->hasPermission('role:index');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function show(User $auth)
    {
        return $auth->hasPermission('role:show');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function create(User $auth)
    {
        return $auth->hasPermission('role:create');
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
     * @param Role $role
     * @return bool
     */
    public function edit(User $auth, Role $role)
    {
        return $auth->hasPermission('role:update');
    }

    /**
     * @param User $auth
     * @param Role $role
     * @return bool
     */
    public function update(User $auth, Role $role)
    {
        return $this->edit($auth, $role);
    }

    /**
     * @param User $auth
     * @param Role $role
     * @return bool
     */
    public function destroy(User $auth, Role $role)
    {
        return $auth->hasPermission('role:delete');
    }

    /**
     * @param User $auth
     * @param Role $role
     * @return bool
     */
    public function restore(User $auth, Role $role)
    {
        return $auth->hasPermission('role:restore');
    }

    /**
     * @param User $auth
     * @param Role $role
     * @return bool
     */
    public function revisions(User $auth, Role $role)
    {
        return $auth->hasPermission('role:revisions');
    }

    /**
     * @param User $auth
     * @param Role $role
     * @return bool
     */
    public function histories(User $auth, Role $role)
    {
        return $auth->hasPermission('role:histories');
    }

    /**
     * @param User $auth
     * @param Role $role
     * @return bool
     */
    public function archives(User $auth, Role $role)
    {
        return $auth->hasPermission('role:archives');
    }

    /**
     * @param User $auth
     * @param Role $role
     * @return bool
     */
    public function duplicate(User $auth, Role $role)
    {
        return $auth->hasPermission('role:duplicate');
    }
}
