<?php

namespace App\Policies;

use App\NoticeType;

class NoticeTypesPolicy extends BasePolicy
{
    public function index()
    {
        return $this->user->hasPermission('notice-type:index');
    }

    public function show()
    {
        return $this->user->hasPermission('notice-type:show');
    }

    public function create()
    {
        return $this->user->hasPermission('notice-type:create');
    }

    public function store()
    {
        return $this->create();
    }

    public function edit(NoticeType $noticeType)
    {
        return $this->user->hasPermission('notice-type:update');
    }

    public function update(NoticeType $noticeType)
    {
        return $this->edit($noticeType);
    }

    public function duplicate(NoticeType $noticeType)
    {
        return $this->user->hasPermission('notice-type:duplicate');
    }

    public function revisions(NoticeType $noticeType)
    {
        return $this->user->hasPermission('notice-type:revisions');
    }

    public function destroy(NoticeType $noticeType)
    {
        return $this->user->hasPermission('notice-type:delete');
    }

    public function activate(NoticeType $noticeType)
    {
        return $this->user->hasPermission('notice-type:activate') && $noticeType->canActivate();
    }

    public function deactivate(NoticeType $noticeType)
    {
        return $this->user->hasPermission('notice-type:deactivate') && $noticeType->canDeactivate();
    }
}