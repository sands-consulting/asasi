<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Vendor;
use App\VendorAccount;
use App\VendorEmployee;
use App\VendorShareholder;
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
        $activeSubs = $vendor->active_subscription;

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

    public static function accounts(Vendor $vendor, $accounts)
    {
        $exists = [];

        foreach($accounts as $data)
        {
            if(empty($data['id']))
            {
                unset($data['id']);
                $account = new VendorAccount($data);
                $vendor->accounts()->save($account);
            }
            else
            {
                $account = $vendor->accounts()->find($data['id']);
                unset($data['id']);
                $account->update($data);
            }

            $exists[] = $account->id;
        }

        $vendor->accounts()->whereNotIn('id', $exists)->delete();
    }

    public static function employees(Vendor $vendor, $employees)
    {
        $exists = [];

        foreach($employees as $data)
        {
            if(empty($data['id']))
            {
                unset($data['id']);
                $employee = new VendorEmployee($data);
                $vendor->employees()->save($employee);
            }
            else
            {
                $employee = $vendor->employees()->find($data['id']);
                unset($data['id']);
                $employee->update($data);
            }

            $exists[] = $employee->id;
        }

        $vendor->employees()->whereNotIn('id', $exists)->delete();
    }

    public static function qualificationCodes(Vendor $vendor, $codes)
    {
    }

    public static function shareholders(Vendor $vendor, $shareholders)
    {
        $exists = [];

        foreach($shareholders as $data)
        {
            if(empty($data['id']))
            {
                unset($data['id']);
                $shareholder = new VendorShareholder($data);
                $vendor->shareholders()->save($shareholder);
            }
            else
            {
                $shareholder = $vendor->shareholders()->find($data['id']);
                unset($data['id']);
                $shareholder->update($data);
            }

            $exists[] = $shareholder->id;
        }

        $vendor->shareholders()->whereNotIn('id', $exists)->delete();
    }
}
