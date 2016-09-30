<?php

namespace App\Repositories;

use App\Events\SubscriptionStatusChanged;
use App\Subscription;
use Carbon\Carbon;
use Event;
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

    public static function deactivate(Subscription $subscription)
    {
        if($subscription->status == 'inactive')
        {
            throw new RepositoryException('Deactivating ' . Subscription::class, $subscription);
        }

        $subscription->status = 'inactive';
        $subscription->save();
    }

    public static function cancel(Subscription $subscription)
    {
        if($subscription->status == 'cancelled')
        {
            throw new RepositoryException('Cancelling ' . Subscription::class, $subscription);
        }

        $subscription->status = 'cancelled';
        $subscription->save();
    }
}
