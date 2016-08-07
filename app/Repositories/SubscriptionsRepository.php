<?php

namespace App\Repositories;

use Event;
use App\Events\SubscriptionStatusChanged;
use App\Subscription;
use Illuminate\Database\Eloquent\Model;
use Sands\Asasi\Foundation\Repository\Exceptions\RepositoryException;

class SubscriptionsRepository extends BaseRepository 
{
    public static function activate(Subscription $subscription)
    {
        if($subscription->status == 'active')
        {
            throw new RepositoryException('Activating ' . Subscription::class, $subscription);
        }

        $subscription->status = 'active';
        $subscription->save();
    }

    public static function expire(Subscription $subscription)
    {
        if($subscription->status == 'cancelled')
        {
            throw new RepositoryException('Deactivating ' . Subscription::class, $subscription);
        }

        $subscription->status = 'expired';
        $subscription->save();
    }

    public static function updateStatusExpired()
    {
        $subscriptions = Subscription::whereStatus('active')->get();
        if (!$subscriptions->isEmpty()) {
            foreach ($subscriptions as $subscription) {
                $vendor = $subscription->vendor;
                $status = 'expired';
                if ($subscription->isExpired()) {
                    static::update($subscription, ['status' => $status]);
                    Event::fire(new SubscriptionStatusChanged($vendor->user, $status));
                }
            }
            return true;
        }
        return false;
    }
}
