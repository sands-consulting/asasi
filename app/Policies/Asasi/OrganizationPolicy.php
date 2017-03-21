<?php

namespace App\Policies\Asasi;

use App\Organization;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class OrganizationPolicy
 * @package App\Policies
 */
class OrganizationPolicy
{
    use HandlesAuthorization;

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
        return $user->hasPermission('organization:delete');
    }

    /**
     * @param User $user
     * @param Organization $organization
     * @return bool
     */
    public function restore(User $user, Organization $organization)
    {
        return $user->hasPermission('organization:restore');
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
    public function histories(User $user, Organization $organization)
    {
        return $user->hasPermission('organization:histories');
    }

    /**
     * @param User $user
     * @param Organization $organization
     * @return bool
     */
    public function archives(User $user, Organization $organization)
    {
        return $user->hasPermission('organization:archives');
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
}
