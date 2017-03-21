<?php

namespace App\Policies;

use App\User;
use App\NoticeType;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class NoticeTypePolicy
 * @package App\Policies
 */
class NoticeTypePolicy
{
    use HandlesAuthorization;

    /**
     * @param User $auth
     * @return bool
     */
    public function index(User $auth)
    {
        return $auth->hasPermission('notice-type:index');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function show(User $auth)
    {
        return $auth->hasPermission('notice-type:show');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function create(User $auth)
    {
        return $auth->hasPermission('notice-type:create');
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
     * @param NoticeType $type
     * @return bool
     */
    public function edit(User $auth, NoticeType $type)
    {
        return $auth->hasPermission('notice-type:update');
    }

    /**
     * @param User $auth
     * @param NoticeType $type
     * @return bool
     */
    public function update(User $auth, NoticeType $type)
    {
        return $this->edit($type);
    }

    /**
     * @param User $auth
     * @param NoticeType $type
     * @return bool
     */
    public function destroy(User $auth, NoticeType $type)
    {
        return $auth->hasPermission('notice-type:delete');
    }

    /**
     * @param User $auth
     * @param NoticeType $type
     * @return bool
     */
    public function restore(User $auth, NoticeType $type)
    {
        return $auth->hasPermission('notice-type:restore');
    }

    /**
     * @param User $auth
     * @param NoticeType $type
     * @return bool
     */
    public function revisions(User $auth, NoticeType $type)
    {
        return $auth->hasPermission('notice-type:revisions');
    }

    /**
     * @param User $auth
     * @param NoticeType $type
     * @return bool
     */
    public function histories(User $auth, NoticeType $type)
    {
        return $auth->hasPermission('notice-type:histories');
    }

    /**
     * @param User $auth
     * @param NoticeType $type
     * @return bool
     */
    public function archives(User $auth, NoticeType $type)
    {
        return $auth->hasPermission('notice-type:archives');
    }

    /**
     * @param User $auth
     * @param NoticeType $type
     * @return bool
     */
    public function duplicate(User $auth, NoticeType $type)
    {
        return $auth->hasPermission('notice-type:duplicate');
    }
}
