<?php

namespace App\Services;

use App\Package;
use App\Subscription;
use App\Transaction;
use App\TransactionLine;
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

        $subscription           = new Subscription;
        $subscription->start_at = $startDate;

        $subscription->package()->associate($package);
        $subscription->subscriber()->associate($vendor);
        $subscription->user()->associate($user);
        $subscription->save();

        $transaction    = new Transaction;
        $transaction->payer()->associate($vendor);
        $transaction->user()->associate($user);
        $transaction->save();

        $line               = new TransactionLine;
        $line->description  = $subscription->transaction_line_description;
        $line->price        = $subscription->package->fee;
        $line->quantity     = 1;
        $line->item()->associate($subscription);
        $line->taxCode()->associate($subscription->package->taxCode);
        $line->transaction()->associate($transaction);
        $line->save();
        $line->transaction->calculate()->save();

        return $subscription;
    }
}
