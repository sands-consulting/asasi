<?php

namespace App\Policies;

use App\Vendor;

class VendorsPolicy extends BasePolicy
{
    public function index()
    {
        return $this->user->hasPermission('vendor:index');
    }

    public function show(Vendor $vendor)
    {
        if($this->user->hasPermission('access:vendor') && $this->user->vendor)
        {
            return $this->user->hasPermission('vendor:show') && $vendor->id === $this->user->vendor->id;
        }

        return $this->user->hasPermission('vendor:show');
    }

    public function create()
    {
        return $this->user->hasPermission('vendor:create');
    }

    public function store()
    {
        return $this->create();
    }

    public function edit(Vendor $vendor)
    {
        return $this->user->hasPermission('vendor:update');
    }

    public function update(Vendor $vendor)
    {
        return $this->edit($vendor);
    }

    public function destroy(Vendor $vendor)
    {
        return $this->user->hasPermission('vendor:delete');
    }

    public function duplicate(Vendor $vendor)
    {
        return $this->user->hasPermission('vendor:duplicate');
    }

    public function revisions(Vendor $vendor)
    {
        return $this->user->hasPermission('vendor:revisions');
    }

    public function logs(Vendor $vendor)
    {
        return $this->user->hasPermission('vendor:logs');
    }

    public function approve()
    {
        return $this->user->hasPermission('vendor:approve');
    }

    public function reject()
    {
        return $this->user->hasPermission('vendor:reject');
    }

    public function activate(Vendor $vendor)
    {
        return $this->user->hasPermission('vendor:activate') && $vendor->canActivate();
    }

    public function suspend(Vendor $vendor)
    {
        return $this->user->hasPermission('vendor:suspend') && $vendor->canSuspend();
    }

    public function blacklist(Vendor $vendor)
    {
        return $this->user->hasPermission('vendor:blacklist') && $vendor->canBlacklist();
    }

    public function unblacklist(Vendor $vendor)
    {
        return $this->user->hasPermission('vendor:unblacklist') && $vendor->canUnblacklist();
    }

    public function qualificationCodes(Vendor $vendor)
    {
        return $this->show($vendor);
    }

    public function subscriptions(Vendor $vendor)
    {
        return $this->show($vendor);
    }
}
