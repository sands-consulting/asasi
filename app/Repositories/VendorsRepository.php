<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Vendor;
use App\Package;
use App\Subscription;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Sands\Asasi\Foundation\Repository\Exceptions\RepositoryException;

class VendorsRepository extends BaseRepository 
{
    public static function activate(Vendor $vendor)
    {
        if($vendor->status == 'active')
        {
            throw new RepositoryException('Activating ' . Vendor::class, $vendor);
        }

        $vendor->status = 'active';
        $vendor->save();
    }

    public static function deactivate(Vendor $vendor)
    {
        if($vendor->status == 'suspended')
        {
            throw new RepositoryException('Deactivating ' . Vendor::class, $vendor);
        }

        $vendor->status = 'inactive';
        $vendor->save();
    }

    public static function subscribe(Vendor $vendor, Package $package)
    {
        $activeSubs = $vendor->subscriptions()->active()->first();

        $started_at = Carbon::today();
        if ($activeSubs) {
            $started_at = $activeSubs->expired_at->copy()->addDay();
        }

        switch($package->validity_type) {
            case 'months':
                $expired_at = $started_at->copy()->addMonths($package->validity_quantity);
                break;
            case 'years':
                $expired_at = $started_at->copy()->addYears($package->validity_quantity);
                break;
        }
        
        $subscription = new Subscription;
        $subscription->started_at =  $started_at;
        $subscription->expired_at =  $expired_at;
        $subscription->package_id =  $package->id;
        $subscription->status = 'active';

        if ($activeSubs) {
            if ($activeSubs->expired_at >= Carbon::today()) {
                $subscription->status = 'paid';
            } else {
                Subscription::where('vendor_id', $vendor->id)
                    ->where('status', 'active')
                    ->update(['status' => 'expired']);
            }
        }

        if ($vendor->subscriptions()->save($subscription)) {
            if ($vendor->status == 'inactive') {
                static::activate($vendor);
            }
        }

        return $subscription;
    }
}
