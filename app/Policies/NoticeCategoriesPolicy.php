<?php

namespace App\Policies;

use App\NoticeCategory;

class NoticeCategoriesPolicy
{
    public function index()
    {
        return $this->user->hasPermission('notice-category:index');
    }

    public function show()
    {
        return $this->user->hasPermission('notice-category:show');
    }

    public function create()
    {
        return $this->user->hasPermission('notice-category:create');
    }

    public function store()
    {
        return $this->create();
    }

    public function edit(NoticeCategory $noticeCategory)
    {
        return $this->user->hasPermission('notice-category:update');
    }

    public function update(NoticeCategory $noticeCategory)
    {
        return $this->edit($noticeCategory);
    }

    public function duplicate(NoticeCategory $noticeCategory)
    {
        return $this->user->hasPermission('notice-category:duplicate');
    }

    public function revisions(NoticeCategory $noticeCategory)
    {
        return $this->user->hasPermission('notice-category:revisions');
    }

    public function destroy(NoticeCategory $noticeCategory)
    {
        return $this->user->hasPermission('notice-category:delete');
    }

    public function activate(NoticeCategory $noticeCategory)
    {
        return $this->user->hasPermission('notice-category:activate') && $noticeCategory->canActivate();
    }

    public function deactivate(NoticeCategory $noticeCategory)
    {
        return $this->user->hasPermission('notice-category:deactivate') && $noticeCategory->canDeactivate();
    }
}