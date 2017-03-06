<?php

namespace App\Policies;

use App\AllocationType;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AllocationTypePolicy
{
    use HandlesAuthorization;

    public function index(User $user)
    {
        return $user->hasPermission('allocation-type:index');
    }

    public function show(User $user, AllocationType $type)
    {
        return $user->hasPermission('allocation-type:show');
    }

    public function create(User $user)
    {
        return $user->hasPermission('allocation-type:create');
    }

    public function store(User $user)
    {
        return $this->create($user);
    }

    public function edit(User $user, AllocationType $type)
    {
        return $user->hasPermission('allocation-type:update');
    }

    public function update(User $user, AllocationType $type)
    {
        return $this->edit($user, $type);
    }

    public function destroy(User $user, AllocationType $type)
    {
        return $user->hasPermission('allocation-type:delete');
    }

    public function duplicate(User $user, AllocationType $type)
    {
        return $user->hasPermission('allocation-type:duplicate');
    }

    public function revisions(User $user, AllocationType $type)
    {
        return $user->hasPermission('allocation-type:revisions');
    }

    public function histories(User $user, AllocationType $type)
    {
        return $user->hasPermission('allocation-type:histories');
    }
}
