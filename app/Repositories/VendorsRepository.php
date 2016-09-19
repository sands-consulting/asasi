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
        $days       = get_days($package->validity_quantity, $package->validity_type);
        $activeSubs = $vendor->subscriptions()->active()->first();

        $started_at = count($activeSubs) > 0 ? $activeSubs->expired_at->copy()->addDay() : Carbon::today();
        $expired_at = $started_at->copy()->addDays($days);
        
        $subscription = new Subscription;
        $subscription->started_at =  $started_at;
        $subscription->expired_at =  $expired_at;
        $subscription->package_id =  $package->id;
        
        // dd($started_at);
        if ($vendor->subscriptions()->save($subscription)) {
            $newSubs = SubscriptionsRepository::update($activeSubs, ['status' => 'inactive']);
            return $newSubs;
        }

    }
}
