<?php

namespace App\Policies;

use App\Allocation;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class AllocationPolicy
 * @package App\Policies
 */
class AllocationPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $auth
     * @return bool
     */
    public function index(User $auth)
    {
        return $auth->hasPermission('allocation:index');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function show(User $auth)
    {
        return $auth->hasPermission('allocation:show');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function create(User $auth)
    {
        return $auth->hasPermission('allocation:create');
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
     * @param Allocation $allocation
     * @return bool
     */
    public function edit(User $auth, Allocation $allocation)
    {
        return $auth->checkOrganization($auth, $allocation, 'allocation:update');
    }

    /**
     * @param User $auth
     * @param Allocation $allocation
     * @return bool
     */
    public function update(User $auth, Allocation $allocation)
    {
        return $this->edit($auth, $allocation);
    }

    /**
     * @param User $auth
     * @param Allocation $allocation
     * @return bool
     */
    public function destroy(User $auth, Allocation $allocation)
    {
        return $auth->checkOrganization($auth, $allocation, 'allocation:delete');
    }

    /**
     * @param User $auth
     * @param Allocation $allocation
     * @return bool
     */
    public function restore(User $auth, Allocation $allocation)
    {
        return $auth->checkOrganization($auth, $allocation, 'allocation:restore');
    }

    /**
     * @param User $auth
     * @param Allocation $allocation
     * @return bool
     */
    public function revisions(User $auth, Allocation $allocation)
    {
        return $auth->checkOrganization($auth, $allocation, 'allocation:revisions');
    }

    /**
     * @param User $auth
     * @param Allocation $allocation
     * @return bool
     */
    public function histories(User $auth, Allocation $allocation)
    {
        return $auth->checkOrganization($auth, $allocation, 'allocation:histories');
    }

    /**
     * @param User $auth
     * @param Allocation $allocation
     * @return bool
     */
    public function archives(User $auth, Allocation $allocation)
    {
        return $auth->checkOrganization($auth, $allocation, 'allocation:archives');
    }

    /**
     * @param User $auth
     * @param Allocation $allocation
     * @return bool
     */
    public function duplicate(User $auth, Allocation $allocation)
    {
        return $auth->hasPermission('allocation:duplicate');
    }

    /**
     * @param User $auth
     * @param Allocation $allocation
     * @param string $permission
     * @return bool
     */
    protected function checkOrganization(User $auth, Allocation $allocation, $permission)
    {
        if(!$auth->hasPermission($permission))
        {
            return false;
        }

        if($auth->hasPermission('allocation:organization'))
        {
            return $user->organizations->pluck('id')->has($allocation->organization_id);
        }

        return true;
    }
}
