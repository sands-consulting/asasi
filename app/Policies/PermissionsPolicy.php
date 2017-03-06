<?php

namespace App\Policies;

use App\Permission;

class PermissionsPolicy
{
    public function index()
    {
        return $this->user->hasPermission('permission:index');
    }

    public function show()
    {
        return $this->user->hasPermission('permission:show');
    }

    public function create()
    {
        return $this->user->hasPermission('permission:create');
    }

    public function store()
    {
        return $this->create();
    }

    public function edit(Permission $permission)
    {
        return $this->user->hasPermission('permission:update') && $permission->name != 'admin';
    }

    public function update(Permission $permission)
    {
        return $this->edit($permission);
    }

    public function destroy(Permission $permission)
    {
        return $this->user->hasPermission('permission:delete') && $permission->name != 'admin';
    }

    public function duplicate(Permission $permission)
    {
        return $this->user->hasPermission('permission:duplicate');
    }

    public function revisions(Permission $permission)
    {
        return $this->user->hasPermission('permission:revisions');
    }

    public function logs(Permission $permission)
    {
        return $this->user->hasPermission('permission:logs');
    }
}
