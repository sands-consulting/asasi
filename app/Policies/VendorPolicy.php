<?php

namespace App\Policies;

use App\User;
use App\Vendor;
use Illuminate\Auth\Access\HandlesAuthorization;

class VendorPolicy
{
    use HandlesAuthorization;

    public function index(User $auth)
    {
        return $auth->hasPermission('vendor:index');
    }

    public function show(User $auth, Vendor $vendor)
    {
        if($auth->hasPermission('access:vendor') && $auth->vendor)
        {
            return $auth->hasPermission('vendor:show') && $vendor->id === $auth->vendor->id;
        }

        return $auth->hasPermission('vendor:show');
    }

    public function create(User $auth)
    {
        return $auth->hasPermission('vendor:create');
    }

    public function store(User $auth)
    {
        return $this->create($auth);
    }

    public function edit(User $auth, Vendor $vendor)
    {
        return $auth->hasPermission('vendor:update');
    }

    public function update(User $auth, Vendor $vendor)
    {
        return $this->edit($auth, $vendor);
    }

    public function destroy(User $auth, Vendor $vendor)
    {
        return $auth->hasPermission('vendor:delete');
    }

    public function duplicate(User $auth, Vendor $vendor)
    {
        return $auth->hasPermission('vendor:duplicate');
    }

    public function revisions(User $auth, Vendor $vendor)
    {
        return $auth->hasPermission('vendor:revisions');
    }

    public function logs(User $auth, Vendor $vendor)
    {
        return $auth->hasPermission('vendor:logs');
    }

    public function approve(User $auth, Vendor $vendor)
    {
        return $auth->hasPermission('vendor:approve') && $vendor->status == 'pending';
    }

    public function reject(User $auth, Vendor $vendor)
    {
        return $auth->hasPermission('vendor:reject') && $vendor->status == 'pending';
    }

    public function activate(User $auth, Vendor $vendor)
    {
        return $auth->hasPermission('vendor:activate')
            && $vendor->status == ['suspended', 'inactive'];
    }

    public function suspend(User $auth, Vendor $vendor)
    {
        return $auth->hasPermission('vendor:suspend')
            && $vendor->status == ['active', 'inactive'];
    }

    public function pending(User $auth, Vendor $vendor)
    {
        return $auth->hasPermission('access:vendor') && $vendor->status == 'pending';
    }
}
