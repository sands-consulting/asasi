<?php

namespace App\Policies;

use App\Role;

class RolesPolicy extends BasePolicy
{
    public function index()
    {
        return $this->user->hasPermission('role:index');
    }

    public function show()
    {
        return $this->user->hasPermission('role:show');
    }

    public function create()
    {
        return $this->user->hasPermission('role:create');
    }

    public function store()
    {
        return $this->create();
    }

    public function edit(Role $role)
    {
        return $this->user->hasPermission('role:update');
    }

    public function update(Role $role)
    {
        return $this->edit($role);
    }

    public function destroy(Role $role)
    {
        return $this->user->hasPermission('role:delete') && $role->name != 'admin';
    }

    public function duplicate(Role $role)
    {
        return $this->user->hasPermission('role:duplicate');
    }

    public function revisions(Role $role)
    {
        return $this->user->hasPermission('role:revisions');
    }

    public function logs(Role $role)
    {
        return $this->user->hasPermission('role:logs');
    }
}
