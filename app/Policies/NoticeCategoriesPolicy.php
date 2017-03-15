<?php

namespace App\Policies;

use App\NoticeCategory;
use App\User;

class NoticeCategoriesPolicy
{
    public function index(User $user)
    {
        return $user->hasPermission('notice-category:index');
    }

    public function show(User $user)
    {
        return $user->hasPermission('notice-category:show');
    }

    public function create(User $user)
    {
        return $user->hasPermission('notice-category:create');
    }

    public function store(User $user)
    {
        return $this->create($user);
    }

    public function edit(User $user, NoticeCategory $noticeCategory)
    {
        return $user->hasPermission('notice-category:update');
    }

    public function update(User $user, NoticeCategory $noticeCategory)
    {
        return $this->edit($user, $noticeCategory);
    }

    public function duplicate(User $user, NoticeCategory $noticeCategory)
    {
        return $user->hasPermission('notice-category:duplicate');
    }

    public function revisions(User $user, NoticeCategory $noticeCategory)
    {
        return $user->hasPermission('notice-category:revisions');
    }

    public function destroy(User $user, NoticeCategory $noticeCategory)
    {
        return $user->hasPermission('notice-category:delete');
    }

    public function activate(User $user, NoticeCategory $noticeCategory)
    {
        return $user->hasPermission('notice-category:activate') && $noticeCategory->canActivate();
    }

    public function deactivate(User $user, NoticeCategory $noticeCategory)
    {
        return $user->hasPermission('notice-category:deactivate') && $noticeCategory->canDeactivate();
    }
}