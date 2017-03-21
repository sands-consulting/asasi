<?php

namespace App\Policies\Asasi;

use App\User;
use App\Package;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class PackagePolicy
 * @package App\Policies
 */
class PackagePolicy
{
    use HandlesAuthorization;

    /**
     * @param User $auth
     * @return bool
     */
    public function index(User $auth)
    {
        return $auth->hasPermission('package:index');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function show(User $auth)
    {
        return $auth->hasPermission('package:show');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function create(User $auth)
    {
        return $auth->hasPermission('package:create');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function store(User $auth)
    {
        return $this->create($auth);
    }

    /**
     * @param User $auth
     * @param Package $package
     * @return bool
     */
    public function edit(User $auth, Package $package)
    {
        return $auth->hasPermission('package:update');
    }

    /**
     * @param User $auth
     * @param Package $package
     * @return bool
     */
    public function update(User $auth, Package $package)
    {
        return $this->edit($package);
    }

    /**
     * @param User $auth
     * @param Package $package
     * @return bool
     */
    public function destroy(User $auth, Package $package)
    {
        return $auth->hasPermission('package:delete');
    }

    /**
     * @param User $auth
     * @param Package $package
     * @return bool
     */
    public function restore(User $auth, Package $package)
    {
        return $auth->hasPermission('package:restore');
    }

    /**
     * @param User $auth
     * @param Package $package
     * @return bool
     */
    public function revisions(User $auth, Package $package)
    {
        return $auth->hasPermission('package:revisions');
    }

    /**
     * @param User $auth
     * @param Package $package
     * @return bool
     */
    public function histories(User $auth, Package $package)
    {
        return $auth->hasPermission('package:histories');
    }

    /**
     * @param User $auth
     * @param Package $package
     * @return bool
     */
    public function archives(User $auth, Package $package)
    {
        return $auth->hasPermission('package:archives');
    }

    /**
     * @param User $auth
     * @param Package $package
     * @return bool
     */
    public function duplicate(User $auth, Package $package)
    {
        return $auth->hasPermission('package:duplicate');
    }
}
