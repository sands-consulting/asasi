<?php

namespace App\Policies;

use App\Notice;

class NoticesPolicy extends BasePolicy
{
    public function index()
    {
        return $this->user->hasPermission('notice:index');
    }

    public function show()
    {
        return $this->user->hasPermission('notice:show');
    }

    public function create()
    {
        return $this->user->hasPermission('notice:create');
    }

    public function store()
    {
        return $this->create();
    }

    public function edit(Notice $notice)
    {
        return $this->user->hasPermission('notice:update');
    }

    public function update(Notice $notice)
    {
        return $this->edit($notice);
    }

    public function duplicate(Notice $notice)
    {
        return $this->user->hasPermission('notice:duplicate');
    }

    public function revisions(Notice $notice)
    {
        return $this->user->hasPermission('notice:revisions');
    }

    public function destroy(Notice $notice)
    {
        return $this->user->hasPermission('notice:delete');
    }

    public function publish(Notice $notice)
    {
        return $this->user->hasPermission('notice:publish') && $notice->canPublish();
    }

    public function unpublish(Notice $notice)
    {
        return $this->user->hasPermission('notice:unpublish') && $notice->canUnpublish();
    }
}