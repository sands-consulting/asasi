<?php

namespace App\Policies;

use App\Role;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    public function index(User $user)
    {
        return $user->hasPermission('role:index');
    }

    public function create(User $user)
    {
        return $user->hasPermission('role:create');
    }

    public function store(User $user)
    {
        return $this->create($user);
    }

    public function show(User $user, Role $role)
    {
        return $user->hasPermission('role:show');
    }

    public function edit(User $user, Role $role)
    {
        return $user->hasPermission('role:edit');
    }

    public function update(User $user, Role $role)
    {
        return $user->edit($user, $role);
    }

    public function destroy(User $user, Role $role)
    {
        return $user->hasPermission('role:delete');
    }

    public function histories(User $user, Role $role)
    {
        return $user->hasPermission('role:histories');
    }

    public function revisions(User $user, Role $role)
    {
        return $user->hasPermission('role:revisions');
    }

    public function duplicate(Role $role)
    {
        return $user->hasPermission('role:duplicate');
    }
}
