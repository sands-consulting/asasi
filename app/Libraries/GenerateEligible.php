<?php

namespace App\Libraries;

use App\Notice;
use App\NoticeEligible;
use App\VendorQualificationCode;
use App\Notifications\NoticeEligible as Notification;

class GenerateEligible
{
    public function __construct($noticeId)
    {
        $this->notice = Notice::find($noticeId);
    }

    public function handle($email=false)
    {
        $index      = 0;
        $vendorIds  = collect([]);
        $groups     = $this->notice->qualificationCodes()->orderBy('group', 'asc')->orderBy('sequence', 'asc')->get()->groupBy('group');

        foreach($groups as $group => $data)
        {
            $groupRule  = $data[0]->group_rule;

            if($groupRule == 'and')
            {
                $groupVendorIds = collect([]);

                foreach($data as $code)
                {
                    if(count($groupVendorIds) == 0)
                    {
                        $groupVendorIds = VendorQualificationCode::whereCodeId($code->code_id)->pluck('vendor_id');
                    }
                    else
                    {
                        $groupVendorIds = $groupVendorIds->intersect(VendorQualificationCode::whereCodeId($code->code_id)->pluck('vendor_id'));
                    }
                }
            }
            else
            {
                $groupVendorIds = VendorQualificationCode::whereIn('code_id', $data->pluck('code_id')->toArray())->pluck('vendor_id');
            }

            $groupVendorIds = $groupVendorIds->unique();

            if($index > 0)
            {
                $joinRule   = $groups[$index-1][0]->join_rule;

                if($joinRule == 'and')
                {
                    $vendorIds = $vendorIds->intersect($groupVendorIds);
                }
                else
                {
                    $vendorIds = $vendorIds->merge($groupVendorIds);
                }
            }
            else
            {
                $vendorIds = $groupVendorIds;
            }
        }

        foreach($vendorIds as $vendorId)
        {
            $eligible = NoticeEligible::firstOrCreate(['notice_id' => $this->notice->id, 'vendor_id' => $vendorId]);

            if($email && $eligible->vendor->status == 'active')
            {
                $users = $eligible->vendor->users()->active()->get();

                foreach($users as $user)
                {
                    $user->notify(new Notification($eligible->notice, $eligible->vendor));
                }

                $eligible->notified_at = Carbon::now();
                $eligible->save();
            }
        }
    }
}