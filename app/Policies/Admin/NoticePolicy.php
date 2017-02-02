<?php

namespace App\Policies\Admin;

use App\Notice;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NoticePolicy
{
    use HandlesAuthorization;

    public function index(User $user)
    {
        return $user->hasPermission('notice:index');
    }

    public function show(User $user)
    {
        return $user->hasPermissions(['notice:show']);
    }

    public function create(User $user)
    {
        return $user->hasPermission('notice:create');
    }

    public function store(User $user)
    {
        return $this->create($user);
    }

    public function edit(User $user, Notice $notice)
    {
        return $user->hasPermission('notice:update');
    }

    public function update(User $user, Notice $notice)
    {
        return $this->edit($notice);
    }

    public function duplicate(User $user, Notice $notice)
    {
        return $user->hasPermission('notice:duplicate');
    }

    public function revisions(User $user, Notice $notice)
    {
        return $user->hasPermission('notice:revisions');
    }

    public function destroy(User $user, Notice $notice)
    {
        return $user->hasPermission('notice:delete');
    }

    public function publish(User $user, Notice $notice)
    {
        return $user->hasPermission('notice:publish') && $notice->canPublish();
    }

    public function unpublish(User $user, Notice $notice)
    {
        return $user->hasPermission('notice:unpublish') && $notice->canUnpublish();
    }

    public function cancel(User $user, Notice $notice)
    {
        return $user->hasPermission('notice:cancel') && $notice->canCancel();
    }

    public function saveEvaluator(User $user, Notice $notice)
    {
        return $user->hasPermission('notice:create');
    }

    public function summary(User $user, Notice $notice)
    {
        return $this->show($user, $notice);
    }

    public function summaryByType(User $user, Notice $notice)
    {
        return $this->show($user, $notice);
    }

    public function summaryEvaluators(User $user, Notice $notice)
    {
        return $this->show($user, $notice);
    }

    public function award(User $user, Notice $notice)
    {
        return $this->show($user, $notice);
    }

    public function storeAward(User $user, Notice $notice)
    {
        return $this->award($user, $notice);
    }

    public function events(User $user, Notice $notice)
    {
        return $this->show($user, $notice);
    }

    public function settings(User $user, Notice $notice)
    {
        return $this->show($user, $notice);
    }

    public function qualificationCodes(User $user, Notice $notice)
    {
        return $this->show($user, $notice);
    }

    public function files(User $user, Notice $notice)
    {
        return $this->show($user, $notice);
    }
}