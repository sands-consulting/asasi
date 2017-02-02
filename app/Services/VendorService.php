<?php

namespace App\Services;

use Carbon\Carbon;
use App\QualificationCode;
use App\QualificationType;
use App\Vendor;
use App\VendorAccount;
use App\VendorEmployee;
use App\VendorShareholder;
use App\Package;
use App\Subscription;
use App\User;
use Sands\Asasi\Service\Exceptions\ServiceException;

class VendorService extends BaseService 
{
    public static function activate(Vendor $vendor)
    {
        if($vendor->status == 'active')
        {
            throw new ServiceException('Activating ' . Vendor::class, $vendor);
        }

        $vendor->status = 'active';
        $vendor->save();
    }

    public static function deactivate(Vendor $vendor)
    {
        if($vendor->status == 'suspended')
        {
            throw new ServiceException('Deactivating ' . Vendor::class, $vendor);
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

    public static function files(Vendor $vendor, $files)
    {
        
    }

    public static function qualificationCodes(Vendor $vendor, $data)
    {
        $types  = QualificationType::whereStatus('active')->get();
        $exists = [];

        foreach($types as $type)
        {
            if($type->type == 'boolean')
            {
                $codeId = array_get($data, $type->code, null);

                if(!empty($codeId))
                {
                    $code       = $vendor->qualificationCodes()->firstOrCreate([
                        'type_id' => $type->id,
                        'code_id' => $codeId
                    ]);
                    $exists[]   = $code->id;
                }
            }

            if($type->type == 'list')
            {
                $codes  = array_get($data, $type->code, []);

                foreach($codes as $id => $value)
                {
                    $code = $vendor->qualificationCodes()->firstOrCreate([
                        'type_id' => $type->id,
                        'code_id' => $id
                    ]);

                    $exists[] = $code->id;

                    if(is_array($value))
                    {
                        foreach($value as $child => $boolean)
                        {
                            $reference = QualificationCode::find($child);
                            if(empty($reference)) continue;
                            $childCode = $vendor->qualificationCodes()->firstOrCreate([
                                'type_id' => $reference->type_id,
                                'code_id' => $reference->id,
                                'parent_id' => $code->id
                            ]);
                            $exists[] = $childCode->id;
                        }
                    }
                }
            }
        }

        $vendor->qualificationCodes()->whereNotIn('id', $exists)->delete();
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
