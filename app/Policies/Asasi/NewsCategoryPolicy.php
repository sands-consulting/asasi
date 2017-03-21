<?php

namespace App\Policies\Asasi;

use App\NewsCategory;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class NewsCategoryPolicy
 * @package App\Policies
 */
class NewsCategoryPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $auth
     * @return bool
     */
    public function index(User $auth)
    {
        return $auth->hasPermission('news-category:index');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function show(User $auth, NewsCategory $category)
    {
        return $auth->hasPermission('news-category:show');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function create(User $auth)
    {
        return $auth->hasPermission('news-category:create');
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
     * @param NewsCategory $category
     * @return bool
     */
    public function edit(User $auth, NewsCategory $category)
    {
        return $auth->hasPermission('news-category:update');
    }

    /**
     * @param User $auth
     * @param NewsCategory $category
     * @return bool
     */
    public function update(User $auth, NewsCategory $category)
    {
        return $this->edit($auth, $category);
    }

    /**
     * @param User $auth
     * @param NewsCategory $category
     * @return bool
     */
    public function destroy(User $auth, NewsCategory $category)
    {
        return $auth->hasPermission('news-category:delete');
    }

    /**
     * @param User $auth
     * @param NewsCategory $category
     * @return bool
     */
    public function restore(User $auth, NewsCategory $category)
    {
        return $auth->hasPermission('news-category:restore');
    }

    /**
     * @param User $auth
     * @param NewsCategory $category
     * @return bool
     */
    public function revisions(User $auth, NewsCategory $category)
    {
        return $auth->hasPermission('news-category:revisions');
    }

    /**
     * @param User $auth
     * @param NewsCategory $category
     * @return bool
     */
    public function histories(User $auth, NewsCategory $category)
    {
        return $auth->hasPermission('news-category:histories');
    }

    /**
     * @param User $auth
     * @param NewsCategory $category
     * @return bool
     */
    public function archives(User $auth, NewsCategory $category)
    {
        return $auth->hasPermission('news-category:archives');
    }

    /**
     * @param User $auth
     * @param NewsCategory $category
     * @return bool
     */
    public function duplicate(User $auth, NewsCategory $category)
    {
        return $auth->hasPermission('news-category:duplicate');
    }
}
