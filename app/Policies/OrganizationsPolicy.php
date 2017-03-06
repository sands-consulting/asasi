<?php

namespace App\Policies;

use App\Organization;

class OrganizationsPolicy
{
    public function index()
    {
        return $this->user->hasPermission('organization:index');
    }

    public function show()
    {
        return $this->user->hasPermission('organization:show');
    }

    public function create()
    {
        return $this->user->hasPermission('organization:create');
    }

    public function store()
    {
        return $this->create();
    }

    public function edit(Organization $organization)
    {
        return $this->user->hasPermission('organization:update');
    }

    public function update(Organization $organization)
    {
        return $this->edit($organization);
    }

    public function destroy(Organization $organization)
    {
        return $this->user->hasPermission('organization:delete') && $organization->name != 'admin';
    }

    public function duplicate(Organization $organization)
    {
        return $this->user->hasPermission('organization:duplicate');
    }

    public function revisions(Organization $organization)
    {
        return $this->user->hasPermission('organization:revisions');
    }

    public function logs(Organization $organization)
    {
        return $this->user->hasPermission('organization:logs');
    }

    public function activate(Organization $organization)
    {
        return $this->user->hasPermission('organization:activate') && $organization->canActivate();
    }

    public function deactivate(Organization $organization)
    {
        return $this->user->hasPermission('organization:deactivate') && $organization->canDeactivate();
    }

    public function suspend(Organization $organization)
    {
        return $this->user->hasPermission('organization:suspend') && $organization->can->Suspend();
    }
}
