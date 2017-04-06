<?php

namespace App\Policies;

use App\User;
use App\NoticeCategory;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class NoticeCategoryPolicy
 * @package App\Policies
 */
class NoticeCategoryPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $auth
     * @return bool
     */
    public function index(User $auth)
    {
        return $auth->hasPermission('notice-category:index');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function show(User $auth)
    {
        return $auth->hasPermission('notice-category:show');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function create(User $auth)
    {
        return $auth->hasPermission('notice-category:create');
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
     * @param NoticeCategory $category
     * @return bool
     */
    public function edit(User $auth, NoticeCategory $category)
    {
        return $auth->hasPermission('notice-category:update');
    }

    /**
     * @param User $auth
     * @param NoticeCategory $category
     * @return bool
     */
    public function update(User $auth, NoticeCategory $category)
    {
        return $this->edit($auth, $category);
    }

    /**
     * @param User $auth
     * @param NoticeCategory $category
     * @return bool
     */
    public function destroy(User $auth, NoticeCategory $category)
    {
        return $auth->hasPermission('notice-category:delete');
    }

    /**
     * @param User $auth
     * @param NoticeCategory $category
     * @return bool
     */
    public function restore(User $auth, NoticeCategory $category)
    {
        return $auth->hasPermission('notice-category:restore');
    }

    /**
     * @param User $auth
     * @param NoticeCategory $category
     * @return bool
     */
    public function revisions(User $auth, NoticeCategory $category)
    {
        return $auth->hasPermission('notice-category:revisions');
    }

    /**
     * @param User $auth
     * @param NoticeCategory $category
     * @return bool
     */
    public function histories(User $auth, NoticeCategory $category)
    {
        return $auth->hasPermission('notice-category:histories');
    }

    /**
     * @param User $auth
     * @param NoticeCategory $category
     * @return bool
     */
    public function archives(User $auth, NoticeCategory $category)
    {
        return $auth->hasPermission('notice-category:archives');
    }

    /**
     * @param User $auth
     * @param NoticeCategory $category
     * @return bool
     */
    public function duplicate(User $auth, NoticeCategory $category)
    {
        return $auth->hasPermission('notice-category:duplicate');
    }
}
