<?php

namespace App\Policies\Asasi;

use App\User;
use App\Subscription;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class SubscriptionPolicy
 * @package App\Policies
 */
class SubscriptionPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $auth
     * @return bool
     */
    public function index(User $auth)
    {
        return $auth->hasPermission('subscription:index');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function show(User $auth)
    {
        return $auth->hasPermission('subscription:show');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function create(User $auth)
    {
        return $auth->hasPermission('subscription:create');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function store(User $auth)
    {
        return $this->create($auth);
    }

    /**
     * @param User $auth
     * @param Subscription $subscription
     * @return bool
     */
    public function edit(User $auth, Subscription $subscription)
    {
        return $auth->hasPermission('subscription:update');
    }

    /**
     * @param User $auth
     * @param Subscription $subscription
     * @return bool
     */
    public function update(User $auth, Subscription $subscription)
    {
        return $this->edit($subscription);
    }

    /**
     * @param User $auth
     * @param Subscription $subscription
     * @return bool
     */
    public function destroy(User $auth, Subscription $subscription)
    {
        return $auth->hasPermission('subscription:delete');
    }

    /**
     * @param User $auth
     * @param Subscription $subscription
     * @return bool
     */
    public function restore(User $auth, Subscription $subscription)
    {
        return $auth->hasPermission('subscription:restore');
    }

    /**
     * @param User $auth
     * @param Subscription $subscription
     * @return bool
     */
    public function revisions(User $auth, Subscription $subscription)
    {
        return $auth->hasPermission('subscription:revisions');
    }

    /**
     * @param User $auth
     * @param Subscription $subscription
     * @return bool
     */
    public function histories(User $auth, Subscription $subscription)
    {
        return $auth->hasPermission('subscription:histories');
    }

    /**
     * @param User $auth
     * @param Subscription $subscription
     * @return bool
     */
    public function archives(User $auth, Subscription $subscription)
    {
        return $auth->hasPermission('subscription:archives');
    }

    /**
     * @param User $auth
     * @param Subscription $subscription
     * @return bool
     */
    public function duplicate(User $auth, Subscription $subscription)
    {
        return $auth->hasPermission('subscription:duplicate');
    }

    /**
     * @param User $auth
     * @param Subscription $subscription
     * @return bool
     */
    public function activate(User $auth, Subscription $subscription)
    {
        return $auth->hasPermission('subscription:activate');
    }

    /**
     * @param User $auth
     * @param Subscription $subscription
     * @return bool
     */
    public function cancel(User $auth, Subscription $subscription)
    {
        return $auth->hasPermission('subscription:cancel');
    }
}
