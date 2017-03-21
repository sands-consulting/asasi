<?php

namespace App\Policies\Asasi;

use App\News;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class NewsPolicy
 * @package App\Policies
 */
class NewsPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $auth
     * @return mixed
     */
/**
     * @param User $auth
     * @return bool
     */
    public function index(User $auth)
    {
        return $auth->hasPermission('news:index');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function show(User $auth, News $news)
    {
        return $this->checkOrganization($auth, $news, 'news:show');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function create(User $auth)
    {
        return $auth->hasPermission('news:create');
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
     * @param News $news
     * @return bool
     */
    public function edit(User $auth, News $news)
    {
        return $this->checkOrganization($auth, $news, 'news:update') && is_null($news->deleted_at);
    }

    /**
     * @param User $auth
     * @param News $news
     * @return bool
     */
    public function update(User $auth, News $news)
    {
        return $this->edit($auth, $news);
    }

    /**
     * @param User $auth
     * @param News $news
     * @return bool
     */
    public function destroy(User $auth, News $news)
    {
        return $this->checkOrganization($auth, $news, 'news:delete') && is_null($news->deleted_at);
    }

    /**
     * @param User $auth
     * @param News $news
     * @return bool
     */
    public function restore(User $auth, News $news)
    {
        return $this->checkOrganization($auth, $news, 'news:restore') && !is_null($news->deleted_at);
    }

    /**
     * @param User $auth
     * @param News $news
     * @return bool
     */
    public function revisions(User $auth, News $news)
    {
        return $auth->hasPermission('news:revisions');
    }

    /**
     * @param User $auth
     * @param News $news
     * @return bool
     */
    public function histories(User $auth, News $news)
    {
        return $auth->hasPermission('news:histories');
    }

    /**
     * @param User $auth
     * @param News $news
     * @return bool
     */
    public function archives(User $auth, News $news)
    {
        return $auth->hasPermission('news:archives');
    }

    /**
     * @param User $auth
     * @param News $news
     * @return bool
     */
    public function duplicate(User $auth, News $news)
    {
        return $auth->hasPermission('news:duplicate');
    }

    /**
     * @param News $news
     * @return bool
     */
    public function publish(User $auth, News $news)
    {
        return $this->checkOrganization($auth, $news, 'news:publish') && $news->status != 'published';
    }

    /**
     * @param User $auth
     * @param News $news
     * @return bool
     */
    public function unpublish(User $auth, News $news)
    {
        return $this->checkOrganization($auth, $news, 'news:unpublish') && $news->status == 'published';
    }

    /**
     * @param User $auth
     * @param News $news
     * @param $permission
     * @return bool
     */
    protected function checkOrganization(User $auth, News $news, $permission)
    {
        if ( ! $auth->hasPermission($permission)) {
            return false;
        }

        if ($auth->hasPermission('news:organization')) {
            return $auth->organizations->pluck('id')->has($news->organization_id);
        }

        return true;
    }
}
