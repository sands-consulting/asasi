<?php

namespace App\Policies;

use App\User;
use App\VendorType;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class VendorTypePolicy
 * @package App\Policies
 */
class VendorTypePolicy
{
    use HandlesAuthorization;

    /**
     * @param User $auth
     * @return bool
     */
    public function index(User $auth)
    {
        return $auth->hasPermission('vendor-type:index');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function show(User $auth, VendorType $type)
    {
        return $auth->hasPermission('vendor-type:show');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function create(User $auth)
    {
        return $auth->hasPermission('vendor-type:create');
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
     * @param VendorType $type
     * @return bool
     */
    public function edit(User $auth, VendorType $type)
    {
        return $auth->hasPermission('vendor-type:update');
    }

    /**
     * @param User $auth
     * @param VendorType $type
     * @return bool
     */
    public function update(User $auth, VendorType $type)
    {
        return $this->edit($auth, $type);
    }

    /**
     * @param User $auth
     * @param VendorType $type
     * @return bool
     */
    public function destroy(User $auth, VendorType $type)
    {
        return $auth->hasPermission('vendor-type:delete') && is_null($type->deleted_at);
    }

    /**
     * @param User $auth
     * @param VendorType $type
     * @return bool
     */
    public function restore(User $auth, VendorType $type)
    {
        return $auth->hasPermission('vendor-type:restore') && !is_null($type->deleted_at);
    }

    /**
     * @param User $auth
     * @param VendorType $type
     * @return bool
     */
    public function revisions(User $auth, VendorType $type)
    {
        return $auth->hasPermission('vendor-type:revisions');
    }

    /**
     * @param User $auth
     * @param VendorType $type
     * @return bool
     */
    public function histories(User $auth, VendorType $type)
    {
        return $auth->hasPermission('vendor-type:histories');
    }

    /**
     * @param User $auth
     * @param VendorType $type
     * @return bool
     */
    public function archives(User $auth, VendorType $type)
    {
        return $auth->hasPermission('vendor-type:archives');
    }

    /**
     * @param User $auth
     * @param VendorType $type
     * @return bool
     */
    public function duplicate(User $auth, VendorType $type)
    {
        return $auth->hasPermission('vendor-type:duplicate');
    }
}
