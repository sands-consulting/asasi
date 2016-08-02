<?php

namespace App\Policies;

use App\NewsCategory;

class NewsCategoriesPolicy extends BasePolicy
{
    public function index()
    {
        return $this->user->hasPermission('news-category:index');
    }

    public function show(NewsCategory $category)
    {
        return $this->user->hasPermission($category, 'news-category:show');
    }

    public function create()
    {
        return $this->user->hasPermission('news-category:create');
    }

    public function store()
    {
        return $this->create();
    }

    public function edit(NewsCategory $category)
    {
        return $this->user->hasPermission('news-category:update');
    }

    public function update(NewsCategory $category)
    {
        return $this->edit($category);
    }

    public function destroy(NewsCategory $category)
    {
        return $this->user->hasPermission('news-category:delete');
    }

    public function duplicate(NewsCategory $category)
    {
        return $this->user->hasPermission('news-category:duplicate');
    }

    public function revisions(NewsCategory $category)
    {
        return $this->user->hasPermission('news-category:revisions');
    }

    public function logs(NewsCategory $category)
    {
        return $this->user->hasPermission('news-category:logs');
    }
}
