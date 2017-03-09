<?php

namespace App\Policies;

use App\NoticeType;
use App\User;

class NoticeTypesPolicy
{
    public function index(User $user)
    {
        return $user->hasPermission('notice-type:index');
    }

    public function show(User $user)
    {
        return $user->hasPermission('notice-type:show');
    }

    public function create(User $user)
    {
        return $user->hasPermission('notice-type:create');
    }

    public function store(User $user)
    {
        return $this->create($user);
    }

    public function edit(User $user, NoticeType $noticeType)
    {
        return $user->hasPermission('notice-type:update');
    }

    public function update(User $user, NoticeType $noticeType)
    {
        return $this->edit($user, $noticeType);
    }

    public function duplicate(User $user, NoticeType $noticeType)
    {
        return $user->hasPermission('notice-type:duplicate');
    }

    public function revisions(User $user, NoticeType $noticeType)
    {
        return $user->hasPermission('notice-type:revisions');
    }

    public function destroy(User $user, NoticeType $noticeType)
    {
        return $user->hasPermission('notice-type:delete');
    }

    public function activate(User $user, NoticeType $noticeType)
    {
        return $user->hasPermission('notice-type:activate') && $noticeType->canActivate();
    }

    public function deactivate(User $user, NoticeType $noticeType)
    {
        return $user->hasPermission('notice-type:deactivate') && $noticeType->canDeactivate();
    }
}