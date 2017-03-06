<?php

namespace App\Policies;

use App\Subscription;

class SubscriptionsPolicy
{
    public function index()
    {
        return $this->user->hasPermission('subscription:index');
    }

    public function show()
    {
        return $this->user->hasPermission('subscription:show');
    }

    public function create()
    {
        return $this->user->hasPermission('subscription:create');
    }

    public function store()
    {
        return $this->create();
    }

    public function edit(Subscription $subscription)
    {
        return $this->user->hasPermission('subscription:update');
    }

    public function update(Subscription $subscription)
    {
        return $this->edit($subscription);
    }

    public function duplicate(Subscription $subscription)
    {
        return $this->user->hasPermission('subscription:duplicate');
    }

    public function revisions(Subscription $subscription)
    {
        return $this->user->hasPermission('subscription:revisions');
    }

    public function destroy(Subscription $subscription)
    {
        return $this->user->hasPermission('subscription:delete');
    }

    public function activate(Subscription $subscription)
    {
        return $this->user->hasPermission('subscription:activate') && $subscription->canActivate();
    }

    public function deactivate(Subscription $subscription)
    {
        return $this->user->hasPermission('subscription:deactivate') && $subscription->canDeactivate();
    }

    public function cancel(Subscription $subscription)
    {
        return $this->user->hasPermission('subscription:cancel') && $subscription->canCancel();
    }
}