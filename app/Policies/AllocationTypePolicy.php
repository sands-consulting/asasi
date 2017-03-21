<?php

namespace App\Policies;

use App\AllocationType;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class AllocationTypePolicy
 * @package App\Policies
 */
class AllocationTypePolicy
{
    use HandlesAuthorization;

    /**
     * @param User $auth
     * @return bool
     */
    public function index(User $auth)
    {
        return $auth->hasPermission('allocation-type:index');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function show(User $auth)
    {
        return $auth->hasPermission('allocation-type:show');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function create(User $auth)
    {
        return $auth->hasPermission('allocation-type:create');
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
     * @param AllocationType $type
     * @return bool
     */
    public function edit(User $auth, AllocationType $type)
    {
        return $auth->hasPermission('allocation-type:update');
    }

    /**
     * @param User $auth
     * @param AllocationType $type
     * @return bool
     */
    public function update(User $auth, AllocationType $type)
    {
        return $this->edit($type);
    }

    /**
     * @param User $auth
     * @param AllocationType $type
     * @return bool
     */
    public function destroy(User $auth, AllocationType $type)
    {
        return $auth->hasPermission('allocation-type:delete');
    }

    /**
     * @param User $auth
     * @param AllocationType $type
     * @return bool
     */
    public function restore(User $auth, AllocationType $type)
    {
        return $auth->hasPermission('allocation-type:restore');
    }

    /**
     * @param User $auth
     * @param AllocationType $type
     * @return bool
     */
    public function revisions(User $auth, AllocationType $type)
    {
        return $auth->hasPermission('allocation-type:revisions');
    }

    /**
     * @param User $auth
     * @param AllocationType $type
     * @return bool
     */
    public function histories(User $auth, AllocationType $type)
    {
        return $auth->hasPermission('allocation-type:histories');
    }

    /**
     * @param User $auth
     * @param AllocationType $type
     * @return bool
     */
    public function archives(User $auth, AllocationType $type)
    {
        return $auth->hasPermission('allocation-type:archives');
    }

    /**
     * @param User $auth
     * @param AllocationType $type
     * @return bool
     */
    public function duplicate(User $auth, AllocationType $type)
    {
        return $auth->hasPermission('allocation-type:duplicate');
    }
}
