<?php

namespace App\Policies;

use App\AllocationType;

class AllocationTypesPolicy extends BasePolicy
{
    public function index()
    {
        return $this->user->hasPermission('allocation-type:index');
    }

    public function show(AllocationType $type)
    {
        return $this->user->hasPermission('allocation-type:show');
    }

    public function create()
    {
        return $this->user->hasPermission('allocation-type:create');
    }

    public function store()
    {
        return $this->create();
    }

    public function edit(AllocationType $type)
    {
        return $this->user->hasPermission('allocation-type:update');
    }

    public function update(AllocationType $type)
    {
        return $this->edit($type);
    }

    public function destroy(AllocationType $type)
    {
        return $this->user->hasPermission('allocation-type:delete');
    }

    public function duplicate(AllocationType $type)
    {
        return $this->user->hasPermission('allocation-type:duplicate');
    }

    public function revisions(AllocationType $type)
    {
        return $this->user->hasPermission('allocation-type:revisions');
    }

    public function logs(AllocationType $type)
    {
        return $this->user->hasPermission('allocation-type:logs');
    }
}
