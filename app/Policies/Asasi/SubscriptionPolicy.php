<?php

namespace App\Policies\Asasi;

use App\User;
use App\Place;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class PlacePolicy
 * @package App\Policies
 */
class SubscriptionPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $auth
     * @return bool
     */
    public function index(User $auth)
    {
        return $auth->hasPermission('place:index');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function show(User $auth)
    {
        return $auth->hasPermission('place:show');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function create(User $auth)
    {
        return $auth->hasPermission('place:create');
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
     * @param Place $place
     * @return bool
     */
    public function edit(User $auth, Place $place)
    {
        return $auth->hasPermission('place:update');
    }

    /**
     * @param User $auth
     * @param Place $place
     * @return bool
     */
    public function update(User $auth, Place $place)
    {
        return $this->edit($place);
    }

    /**
     * @param User $auth
     * @param Place $place
     * @return bool
     */
    public function destroy(User $auth, Place $place)
    {
        return $auth->hasPermission('place:delete');
    }

    /**
     * @param User $auth
     * @param Place $place
     * @return bool
     */
    public function restore(User $auth, Place $place)
    {
        return $auth->hasPermission('place:restore');
    }

    /**
     * @param User $auth
     * @param Place $place
     * @return bool
     */
    public function revisions(User $auth, Place $place)
    {
        return $auth->hasPermission('place:revisions');
    }

    /**
     * @param User $auth
     * @param Place $place
     * @return bool
     */
    public function histories(User $auth, Place $place)
    {
        return $auth->hasPermission('place:histories');
    }

    /**
     * @param User $auth
     * @param Place $place
     * @return bool
     */
    public function archives(User $auth, Place $place)
    {
        return $auth->hasPermission('place:archives');
    }

    /**
     * @param User $auth
     * @param Place $place
     * @return bool
     */
    public function duplicate(User $auth, Place $place)
    {
        return $auth->hasPermission('place:duplicate');
    }
}
