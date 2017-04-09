<?php

namespace App\Services;

use App\Package;
use App\Subscription;
use App\User;
use App\Vendor;
use Carbon\Carbon;
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

    public static function subscribe(Vendor $vendor, Package $package, User $user)
    {
        if($vendor->subscriptions()->active()->count() > 0)
        {
            $subscription   = $vendor->subscriptions()->active()->orderBy('created_at', 'desc')->first();
            $startDate      = $subscription->start_at;
        }
        else
        {
            $startDate  = Carbon::now()->startOfDay();
        }


        switch ($package->validity_type) {
            case 'days':
                $endDate    = $startDate->copy()->addDays($package->validity_quantity);
                break;

            case 'months':
                $endDate    = $startDate->copy()->addMonths($package->validity_quantity);
                break;

            case 'years':
                $endDate    = $startDate->copy()->addYears($package->validity_quantity);
                break;

            default:
                break;
        }

        $endDate = $endDate->endOfDay();

        $subscription = Subscription::create([
            'number' => strtoupper(str_random(8)),
            'start_at' => $startDate,
            'end_at' => $endDate,
            'package_id' => $package->id,
            'subscriber_type' => 'App\Vendor',
            'subscriber_id' => $vendor->id,
            'user_id' => $user->id
        ]);
    }
}
