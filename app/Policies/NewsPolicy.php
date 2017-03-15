<?php

namespace App\Policies;

use App\News;
use App\User;

/**
 * Class NewsPolicy
 * @package App\Policies
 */
class NewsPolicy
{
    /**
     * @param User $user
     * @return mixed
     */
    public function index(User $user)
    {
        return $user->hasPermission('news:index');
    }

    /**
     * @param User $user
     * @param News $news
     * @return bool
     */
    public function show(User $user, News $news)
    {
        return $this->checkOrganization($user, $news, 'news:show');
    }

    /**
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermission($user, 'news:create');
    }

    /**
     * @return mixed
     */
    public function store()
    {
        return $this->create();
    }

    /**
     * @param News $news
     * @return bool
     */
    public function edit(User $user, News $news)
    {
        return $this->checkOrganization($user, $news, 'news:update');
    }

    /**
     * @param News $news
     * @return bool
     */
    public function update(News $news)
    {
        return $this->edit($news);
    }

    /**
     * @param News $news
     * @return bool
     */
    public function destroy(User $user, News $news)
    {
        return $this->checkOrganization($user, $news, 'news:delete');
    }

    /**
     * @param News $news
     * @return bool
     */
    public function duplicate(User $user, News $news)
    {
        return $this->checkOrganization($user, $news, 'news:duplicate');
    }

    /**
     * @param News $news
     * @return bool
     */
    public function revisions(User $user, News $news)
    {
        return $this->checkOrganization($user, $news, 'news:revisions');
    }

    /**
     * @param News $news
     * @return bool
     */
    public function logs(User $user, News $news)
    {
        return $this->checkOrganization($user, $news, 'news:logs');
    }

    /**
     * @param News $news
     * @return bool
     */
    public function publish(User $user, News $news)
    {
        return $this->checkOrganization($user, $news, 'news:publish') && $news->canPublish();
    }

    /**
     * @param User $user
     * @param News $news
     * @return bool
     */
    public function unpublish(User $user, News $news)
    {
        return $this->checkOrganization($user, $news, 'news:unpublish') && $news->canUnpublish();
    }

    /**
     * @param User $user
     * @param News $news
     * @param $permission
     * @return bool
     */
    protected function checkOrganization(User $user, News $news, $permission)
    {
        if ( ! $user->hasPermission($permission)) {
            return false;
        }

        if ($user->hasPermission('news:organization')) {
            return $user->organizations->pluck('id')->has($news->organization_id);
        }

        return true;
    }
}
