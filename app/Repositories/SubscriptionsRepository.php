<?php

namespace App\Repositories;

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
}
