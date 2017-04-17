<?php

namespace App\Services;

use App\Address;
use App\NoticePurchase;
use App\Package;
use App\QualificationCode;
use App\QualificationType;
use App\Subscription;
use App\Vendor;
use App\VendorAccount;
use App\VendorEmployee;
use App\VendorShareholder;
use App\Upload;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
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

    public static function suspend(Vendor $vendor)
    {
        if($vendor->status == 'suspended')
        {
            throw new ServiceException('Deactivating ' . Vendor::class, $vendor);
        }

        $vendor->status = 'inactive';
        $vendor->save();
    }

    public static function address(Vendor $vendor, $inputs)
    {
        if($vendor->address)
        {
            $vendor->address()->update($inputs);
        }
        else
        {
            $vendor->address()->save(new Address($inputs));
        }
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

    public static function files(Vendor $vendor, $files, $uploads)
    {
        $exists = [];

        foreach($files as $index => $data)
        {
            if(isset($uploads[$index]))
            {
                unset($data['id']);

                $file   = $uploads[$index]['file'];
                $name   = sprintf('%s.%s', md5($file->getClientOriginalName()), $file->extension());
                $token  = md5(time());
                $file->storeAs($token, $name, 'uploads');

                $upload = Upload::create([
                    'name' => $file->getClientOriginalName(),
                    'token' => $token,
                    'path' => public_path(sprintf('%s/%s', $token, $name)),
                    'url' => url(sprintf('%s/%s/%s', 'uploads', $token, $name)),
                    'size' => $file->getSize(),
                    'mime_type' => $file->getMimeType(),
                    'uploadable_type' => 'App\Vendor',
                    'uploadable_id' => $vendor->id,
                    'user_id' => Auth::check() ? Auth::user()->id : null,
                ]);
            }

            if(empty($data['id']))
            {
                $vendorFile = $vendor->files()->create([
                    'type_id' => $data['type_id'],
                    'upload_id' => $upload->id
                ]);

                $exists[] = $vendorFile->id;
            }
            else
            {
                $vendorFile = $vendor->files()->find($data['id']);
                $vendorFile->update(['type_id' => $data['type_id']]);
                $exists[] = $vendorFile->id;
            }
        }

        $vendor->files()->whereNotIn('id', $exists)->delete();
    }

    public static function qualifications(Vendor $vendor, $data)
    {
        $types  = QualificationType::whereStatus('active')->get();
        $exists = [];

        foreach($data as $typeId => $data)
        {
            $type = QualificationType::whereStatus('active')->find($typeId);

            if(!$type)
            {
                continue;
            }

            if(isset($data['codes']))
            {
                $codes = $data['codes'];
                unset($data['codes']);
            }

            $dataToSave = [];

            if(!empty($type->reference_one) && isset($data['reference_one']) && !empty($data['reference_one']))
            {
                $dataToSave['reference_one'] = $data['reference_one'];
            }

            if(!empty($type->reference_two) && isset($data['reference_two']) && !empty($data['reference_two']))
            {
                $dataToSave['reference_two'] = $data['reference_two'];
            }

            if($type->validity
                && isset($data['start_at']) && !empty($data['start_at'])
                && isset($data['end_at']) && !empty($data['end_at']) )
            {
                $dataToSave['start_at'] = $data['start_at'];
                $dataToSave['end_at'] = $data['end_at'];
            }

            if(count($dataToSave) == 0)
            {
                $vendor->qualifications()->whereTypeId($type->id)->delete();
                $vendor->codes()->whereTypeId($type->id)->delete();
                continue;
            }

            $qualification = $vendor->qualifications()->firstOrCreate(['type_id' => $typeId ]);
            $qualification->update($dataToSave);

            if($type->type == 'boolean')
            {
                $code = $type->codes()->first();

                $vendorCode = $vendor->codes()->firstOrCreate([
                    'type_id' => $type->id,
                    'code_id' => $code->id,
                ]);

                $exists[] = $vendorCode->id;
            }

            if($type->type == 'list' && isset($codes))
            {
                
                foreach($codes as $data) {
                    $code = QualificationCode::whereId($data['code_id'])->first();

                    if(!$code)
                    {
                        continue;
                    }

                    $parent = $vendor->codes()->firstOrCreate([
                        'type_id' => $code->type_id,
                        'code_id' => $code->id
                    ]);

                    $exists[] = $parent->id;

                    if(isset($data['children']))
                    {
                        foreach($data['children'] as $childData) {
                            $childCode = QualificationCode::whereId($childData['code_id'])->first();
                            $child = $vendor->codeS()->firstOrCreate([
                                'type_id' => $childCode->type_id,
                                'code_id' => $childCode->id,
                                'parent_id' => $parent->id
                            ]);
                            $exists[] = $child->id;
                        }
                    }
                }
            }
        }

        $vendor->codes()->whereNotIn('id', $exists)->delete();
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

    public static function purchaseCount($limit = null)
    {
        $purchases = \DB::table('notice_purchases')
            ->selectRaw('vendors.name as vendor_name, count(notice_id) as purchases')
            ->leftJoin('vendors', 'vendors.id', '=', 'notice_purchases.vendor_id')
            ->groupBy('vendor_id', 'vendors.name')
            ->get();

        return $purchases->take($limit);
    }
}
