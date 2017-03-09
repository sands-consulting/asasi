<?php

namespace App\Policies;

use App\Package;
use App\User;

class PackagesPolicy
{
    public function index(User $user)
    {
        return $user->hasPermission('package:index');
    }

    public function show(User $user)
    {
        return $user->hasPermission('package:show');
    }

    public function create(User $user)
    {
        return $user->hasPermission('package:create');
    }

    public function store(User $user)
    {
        return $this->create($user);
    }

    public function edit(User $user, Package $package)
    {
        return $user->hasPermission('package:update');
    }

    public function update(User $user, Package $package)
    {
        return $this->edit($user, $package);
    }

    public function duplicate(User $user, Package $package)
    {
        return $user->hasPermission('package:duplicate');
    }

    public function revisions(User $user, Package $package)
    {
        return $user->hasPermission('package:revisions');
    }

    public function destroy(User $user, Package $package)
    {
        return $user->hasPermission('package:delete');
    }

    public function activate(User $user, Package $package)
    {
        return $user->hasPermission('package:activate') && $package->canActivate();
    }

    public function deactivate(User $user, Package $package)
    {
        return $user->hasPermission('package:deactivate') && $package->canDeactivate();
    }
}