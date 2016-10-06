<?php

namespace App\Policies;

use App\Allocation;

class AllocationsPolicy extends BasePolicy
{
    public function index()
    {
        return $this->user->hasPermission('allocation:index');
    }

    public function show(Allocation $allocation)
    {
        return $this->checkOrganization($allocation, 'allocation:show');
    }

    public function create()
    {
        return $this->user->hasPermission('allocation:create');
    }

    public function store()
    {
        return $this->create();
    }

    public function edit(Allocation $allocation)
    {
        return $this->checkOrganization($allocation, 'allocation:update');
    }

    public function update(Allocation $allocation)
    {
        return $this->edit($allocation);
    }

    public function destroy(Allocation $allocation)
    {
        return $this->checkOrganization($allocation, 'allocation:delete');
    }

    public function duplicate(Allocation $allocation)
    {
        return $this->checkOrganization($allocation, 'allocation:duplicate');
    }

    public function revisions(Allocation $allocation)
    {
        return $this->checkOrganization($allocation, 'allocation:revisions');
    }

    public function logs(Allocation $allocation)
    {
        return $this->checkOrganization($allocation, 'allocation:logs');
    }

    public function activate(Allocation $allocation)
    {
        return $this->checkOrganization($allocation, 'allocation:activate') && $allocation->canActivate();
    }

    public function deactivate(Allocation $allocation)
    {
        return $this->checkOrganization($allocation, 'allocation:deactivate') && $allocation->canDeactivate();
    }

    protected function checkOrganization(Allocation $allocation, $permission)
    {
        if(!$this->user->hasPermission($permission))
        {
            return false;
        }

        if($this->user->hasPermission('allocation:organization'))
        {
            return $this->user->organizations->lists('id')->has($allocation->organization_id);
        }

        return true;
    }
}
