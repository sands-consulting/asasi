<?php

namespace App\Policies;

use App\Permission;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization;

    public function index(User $user)
    {
        return $user->hasPermission('permission:index');
    }

    public function create(User $user)
    {
        return $user->hasPermission('permission:create');
    }

    public function store(User $user)
    {
        return $this->create($user);
    }

    public function show(User $user, Permission $permission)
    {
        return $user->hasPermission('permission:show');
    }

    public function edit(User $user, Permission $permission)
    {
        return $user->hasPermission('permission:edit');
    }

    public function update(User $user, Permission $permission)
    {
        return $user->edit($user, $permission);
    }

    public function destroy(User $user, Permission $permission)
    {
        return $user->hasPermission('permission:delete');
    }

    public function histories(User $user, Permission $permission)
    {
        return $user->hasPermission('permission:histories');
    }

    public function revisions(User $user, Permission $permission)
    {
        return $user->hasPermission('permission:revisions');
    }
}
