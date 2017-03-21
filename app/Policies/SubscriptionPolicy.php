<?php

namespace App\Policies;

use App\Subscription;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubscriptionPolicy
{
    use HandlesAuthorization;

    public function index(User $auth)
    {
        return $auth->hasPermission('subscription:index');
    }

    public function show(User $auth)
    {
        return $auth->hasPermission('subscription:show');
    }

    public function create(User $auth)
    {
        return $auth->hasPermission('subscription:create');
    }

    public function store(User $auth)
    {
        return $this->create($auth);
    }

    public function edit(User $auth, Subscription $subscription)
    {
        return $auth->hasPermission('subscription:update');
    }

    public function update(User $auth, Subscription $subscription)
    {
        return $this->edit($subscription);
    }

    public function destroy(User $auth, Subscription $subscription)
    {
        return $auth->hasPermission('subscription:delete') && is_null($subscription->deleted_at);
    }

    public function restore(User $auth, Subscription $subscription)
    {
        return $auth->hasPermission('subscription:restore') && !is_null($subscription->deleted_at);
    }

    public function histories(User $auth, Subscription $subscription)
    {
        return $auth->hasPermission('subscription:histories');
    }

    public function revisions(User $auth, Subscription $subscription)
    {
        return $auth->hasPermission('subscription:revisions');
    }

    public function duplicate(User $auth, Subscription $subscription)
    {
        return $auth->hasPermission('subscription:duplicate');
    }

    public function activate(User $auth, Subscription $subscription)
    {
        return $auth->hasPermission('subscription:activate') && $subscription->status == 'pending';
    }

    public function cancel(User $auth, Subscription $subscription)
    {
        return $auth->hasPermission('subscription:deactivate') && $subscription->status == 'active';
    }
}