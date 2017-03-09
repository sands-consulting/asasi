<?php

namespace App\Policies;

use App\Organization;
use App\User;

/**
 * Class OrganizationPolicy
 * @package App\Policies
 */
class OrganizationPolicy
{
    /**
     * @param User $user
     * @return bool
     */
    public function index(User $user)
    {
        return $user->hasPermission('organization:index');
    }

    /**
     * @param User $user
     * @return bool
     */
    public function show(User $user)
    {
        return $user->hasPermission('organization:show');
    }

    /**
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->hasPermission('organization:create');
    }

    /**
     * @param User $user
     * @return bool
     */
    public function store(User $user)
    {
        return $this->create($user);
    }

    /**
     * @param User $user
     * @param Organization $organization
     * @return bool
     */
    public function edit(User $user, Organization $organization)
    {
        return $user->hasPermission('organization:update');
    }

    /**
     * @param User $user
     * @param Organization $organization
     * @return bool
     */
    public function update(User $user, Organization $organization)
    {
        return $this->edit($organization);
    }

    /**
     * @param User $user
     * @param Organization $organization
     * @return bool
     */
    public function destroy(User $user, Organization $organization)
    {
        return $user->hasPermission('organization:delete') && $organization->name != 'admin';
    }

    /**
     * @param User $user
     * @param Organization $organization
     * @return bool
     */
    public function duplicate(User $user, Organization $organization)
    {
        return $user->hasPermission('organization:duplicate');
    }

    /**
     * @param User $user
     * @param Organization $organization
     * @return bool
     */
    public function revisions(User $user, Organization $organization)
    {
        return $user->hasPermission('organization:revisions');
    }

    /**
     * @param User $user
     * @param Organization $organization
     * @return bool
     */
    public function logs(User $user, Organization $organization)
    {
        return $user->hasPermission('organization:logs');
    }

    /**
     * @param User $user
     * @param Organization $organization
     * @return bool
     */
    public function activate(User $user, Organization $organization)
    {
        return $user->hasPermission('organization:activate') && $organization->canActivate();
    }

    /**
     * @param User $user
     * @param Organization $organization
     * @return bool
     */
    public function deactivate(User $user, Organization $organization)
    {
        return $user->hasPermission('organization:deactivate') && $organization->canDeactivate();
    }

    /**
     * @param User $user
     * @param Organization $organization
     * @return bool
     */
    public function suspend(User $user, Organization $organization)
    {
        return $user->hasPermission('organization:suspend') && $organization->can->Suspend();
    }
}
