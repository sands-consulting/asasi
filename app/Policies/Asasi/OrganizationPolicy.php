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
     * @param User $auth
     * @return bool
     */
    public function index(User $auth)
    {
        return $auth->hasPermission('organization:index');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function show(User $auth)
    {
        return $auth->hasPermission('organization:show');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function create(User $auth)
    {
        return $auth->hasPermission('organization:create');
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
     * @param Organization $organization
     * @return bool
     */
    public function edit(User $auth, Organization $organization)
    {
        return $auth->hasPermission('organization:update');
    }

    /**
     * @param User $auth
     * @param Organization $organization
     * @return bool
     */
    public function update(User $auth, Organization $organization)
    {
        return $this->edit($auth, $organization);
    }

    /**
     * @param User $auth
     * @param Organization $organization
     * @return bool
     */
    public function destroy(User $auth, Organization $organization)
    {
        return $auth->hasPermission('organization:delete');
    }

    /**
     * @param User $auth
     * @param Organization $organization
     * @return bool
     */
    public function restore(User $auth, Organization $organization)
    {
        return $auth->hasPermission('organization:restore');
    }

    /**
     * @param User $auth
     * @param Organization $organization
     * @return bool
     */
    public function revisions(User $auth, Organization $organization)
    {
        return $auth->hasPermission('organization:revisions');
    }

    /**
     * @param User $auth
     * @param Organization $organization
     * @return bool
     */
    public function histories(User $auth, Organization $organization)
    {
        return $auth->hasPermission('organization:histories');
    }

    /**
     * @param User $auth
     * @param Organization $organization
     * @return bool
     */
    public function archives(User $auth, Organization $organization)
    {
        return $auth->hasPermission('organization:archives');
    }

    /**
     * @param User $auth
     * @param Organization $organization
     * @return bool
     */
    public function duplicate(User $auth, Organization $organization)
    {
        return $auth->hasPermission('organization:duplicate');
    }

    public function activate(User $auth, Organization $organization)
    {
        return $this->update($auth, $organization)
            && $organization->status !== 'active';
    }

    public function deactivate(User $auth, Organization $organization)
    {
        return $this->update($auth, $organization);
    }
}
