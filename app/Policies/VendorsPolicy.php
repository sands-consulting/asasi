<?php

namespace App\Policies;

use App\Vendor;

class VendorsPolicy extends BasePolicy
{
     public function index()
    {
        return $this->user->hasPermission('vendor:index');
    }

    public function show()
    {
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

    public function activate(Vendor $vendor)
    {
        return $this->user->hasPermission('vendor:activate') && $vendor->canActivate();
    }

    public function deactivate(Vendor $vendor)
    {
        return $this->user->hasPermission('vendor:deactivate') && $vendor->canDeactivate();
    }
}