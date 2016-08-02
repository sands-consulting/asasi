<?php

namespace App\Policies;

use App\Package;

class PackagesPolicy extends BasePolicy
{
    public function index()
    {
        return $this->user->hasPermission('package:index');
    }

    public function show()
    {
        return $this->user->hasPermission('package:show');
    }

    public function create()
    {
        return $this->user->hasPermission('package:create');
    }

    public function store()
    {
        return $this->create();
    }

    public function edit(Package $package)
    {
        return $this->user->hasPermission('package:update');
    }

    public function update(Package $package)
    {
        return $this->edit($package);
    }

    public function duplicate(Package $package)
    {
        return $this->user->hasPermission('package:duplicate');
    }

    public function revisions(Package $package)
    {
        return $this->user->hasPermission('package:revisions');
    }

    public function destroy(Package $package)
    {
        return $this->user->hasPermission('package:delete');
    }

    public function activate(Package $package)
    {
        return $this->user->hasPermission('package:activate') && $package->canActivate();
    }

    public function deactivate(Package $package)
    {
        return $this->user->hasPermission('package:deactivate') && $package->canDeactivate();
    }
}