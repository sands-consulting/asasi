<?php

namespace App\Policies\Admin;

use App\Notice;
use App\Policies\BasePolicy;

class NoticesPolicy extends BasePolicy
{
    public function index()
    {
        return $this->user->hasPermission('notice:index');
    }

    public function show()
    {
        return $this->user->hasPermissions(['notice:show']);
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

    public function cancel(Notice $notice)
    {
        return $this->user->hasPermission('notice:cancel') && $notice->canCancel();
    }

    public function saveEvaluator(Notice $notice)
    {
        return $this->create();
    }

    public function summary()
    {
        return $this->show();
    }

    public function summaryByType()
    {
        return $this->show();
    }

    public function summaryEvaluators()
    {
        return $this->show();
    }

    public function award()
    {
        return $this->show();
    }

    public function storeAward()
    {
        return $this->award();
    }

    public function events()
    {
        return $this->show();
    }

    public function settings()
    {
        return $this->show();
    }

    public function qualificationCodes()
    {
        return $this->show();
    }

    public function files()
    {
        return $this->show();
    }
}