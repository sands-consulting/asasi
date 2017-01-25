<?php

namespace App\Services;

use App\Events\SubscriptionStatusChanged;
use App\Subscription;
use Carbon\Carbon;
use Event;
use Illuminate\Database\Eloquent\Model;
use Sands\Asasi\Service\Exceptions\ServiceException;

class SubscriptionService extends BaseService 
{
    public static function activate(Subscription $subscription)
    {
        if($subscription->status == 'active')
        {
            throw new ServiceException('Activating ' . Subscription::class, $subscription);
        }

        $subscription->status = 'active';
        $subscription->save();
    }

    public static function deactivate(Subscription $subscription)
    {
        if($subscription->status == 'inactive')
        {
            throw new ServiceException('Deactivating ' . Subscription::class, $subscription);
        }

        $subscription->status = 'inactive';
        $subscription->save();
    }

    public static function cancel(Subscription $subscription)
    {
        if($subscription->status == 'cancelled')
        {
            throw new ServiceException('Cancelling ' . Subscription::class, $subscription);
        }

        $subscription->status = 'cancelled';
        $subscription->save();
    }
}
