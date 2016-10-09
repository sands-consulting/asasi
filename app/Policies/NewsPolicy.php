<?php

namespace App\Policies;

use App\News;

class NewsPolicy extends BasePolicy
{
    public function index()
    {
        return $this->user->hasPermission('news:index');
    }

    public function show(News $news)
    {
        return $this->checkOrganization($news, 'news:show');
    }

    public function create()
    {
        return $this->user->hasPermission('news:create');
    }

    public function store()
    {
        return $this->create();
    }

    public function edit(News $news)
    {
        return $this->checkOrganization($news, 'news:update');
    }

    public function update(News $news)
    {
        return $this->edit($news);
    }

    public function destroy(News $news)
    {
        return $this->checkOrganization($news, 'news:delete');
    }

    public function duplicate(News $news)
    {
        return $this->checkOrganization($news, 'news:duplicate');
    }

    public function revisions(News $news)
    {
        return $this->checkOrganization($news, 'news:revisions');
    }

    public function logs(News $news)
    {
        return $this->checkOrganization($news, 'news:logs');
    }

    public function publish(News $news)
    {
        return $this->checkOrganization($news, 'news:publish') && $news->canPublish();
    }

    public function unpublish(News $news)
    {
        return $this->checkOrganization($news, 'news:unpublish') && $news->canUnpublish();
    }

    protected function checkOrganization(News $news, $permission)
    {
        if(!$this->user->hasPermission($permission))
        {
            return false;
        }

        if($this->user->hasPermission('news:organization'))
        {
            return $this->user->organizations->lists('id')->has($news->organization_id);
        }

        return true;
    }
}
