<?php

namespace App\Policies;

use App\User;
use App\Vendor;
use Illuminate\Auth\Access\HandlesAuthorization;

class VendorsPolicy
{
    use HandlesAuthorization;

    public function index(User $user)
    {
        return $user->hasPermission('vendor:index');
    }

    public function show(User $user, Vendor $vendor)
    {
        if($user->hasPermission('access:vendor') && $user->vendor)
        {
            return $user->hasPermission('vendor:show') && $vendor->id === $user->vendor->id;
        }

        return $user->hasPermission('vendor:show');
    }

    public function create(User $user)
    {
        return $user->hasPermission('vendor:create');
    }

    public function store(User $user)
    {
        return $this->create($user);
    }

    public function edit(User $user, Vendor $vendor)
    {
        return $user->hasPermission('vendor:update');
    }

    public function update(User $user, Vendor $vendor)
    {
        return $this->edit($user, $vendor);
    }

    public function destroy(User $user, Vendor $vendor)
    {
        return $user->hasPermission('vendor:delete');
    }

    public function duplicate(User $user, Vendor $vendor)
    {
        return $user->hasPermission('vendor:duplicate');
    }

    public function revisions(User $user, Vendor $vendor)
    {
        return $user->hasPermission('vendor:revisions');
    }

    public function logs(User $user, Vendor $vendor)
    {
        return $user->hasPermission('vendor:logs');
    }

    public function approve(User $user)
    {
        return $user->hasPermission('vendor:approve');
    }

    public function reject(User $user)
    {
        return $user->hasPermission('vendor:reject');
    }

    public function activate(User $user, Vendor $vendor)
    {
        return $user->hasPermission('vendor:activate') && $vendor->canActivate($user);
    }

    public function suspend(User $user, Vendor $vendor)
    {
        return $user->hasPermission('vendor:suspend') && $vendor->canSuspend($user);
    }

    public function blacklist(User $user, Vendor $vendor)
    {
        return $user->hasPermission('vendor:blacklist') && $vendor->canBlacklist($user);
    }

    public function unblacklist(User $user, Vendor $vendor)
    {
        return $user->hasPermission('vendor:unblacklist') && $vendor->canUnblacklist($user);
    }

    public function qualificationCodes(User $user, Vendor $vendor)
    {
        return $this->show($user, $vendor);
    }

    public function subscriptions(User $user, Vendor $vendor)
    {
        return $this->show($user, $vendor);
    }

    public function pending(User $user, Vendor $vendor)
    {
        return $user->hasPermission('access:vendor') && $vendor->status == 'pending';
    }
}
