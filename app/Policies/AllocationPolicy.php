<?php

namespace App\Policies;

use App\Allocation;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AllocationPolicy
{
    use HandlesAuthorization;

    public function index(User $user)
    {
        return $user->hasPermission('allocation:index');
    }

    public function show(User $user, Allocation $allocation)
    {
        return $this->checkOrganization($user, $allocation, 'allocation:show');
    }

    public function create(User $user)
    {
        return $user->hasPermission('allocation:create');
    }

    public function store(User $user)
    {
        return $this->create($user);
    }

    public function edit(User $user, Allocation $allocation)
    {
        return $this->checkOrganization($user, $allocation, 'allocation:update');
    }

    public function update(User $user, Allocation $allocation)
    {
        return $this->edit($allocation);
    }

    public function destroy(User $user, Allocation $allocation)
    {
        return $this->checkOrganization($user, $allocation, 'allocation:delete');
    }

    public function duplicate(User $user, Allocation $allocation)
    {
        return $this->checkOrganization($user, $allocation, 'allocation:duplicate');
    }

    public function revisions(User $user, Allocation $allocation)
    {
        return $this->checkOrganization($user, $allocation, 'allocation:revisions');
    }

    public function histories(User $user, Allocation $allocation)
    {
        return $this->checkOrganization($user, $allocation, 'allocation:histories');
    }

    public function activate(User $user, Allocation $allocation)
    {
        return $this->checkOrganization($user, $allocation, 'allocation:activate') && $allocation->status != 'active';
    }

    public function deactivate(User $user, Allocation $allocation)
    {
        return $this->checkOrganization($user, $allocation, 'allocation:deactivate') && $allocation->status == 'active';
    }

    protected function checkOrganization(User $user, Allocation $allocation, $permission)
    {
        if(!$user->hasPermission($permission))
        {
            return false;
        }

        if($user->hasPermission('allocation:organization'))
        {
            return $user->organizations->pluck('id')->has($allocation->organization_id);
        }

        return true;
    }
}
