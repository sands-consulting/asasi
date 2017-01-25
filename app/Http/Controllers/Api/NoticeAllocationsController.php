<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\AuthLogsService;
use App\Http\Controllers\Controller;
use App\Notice;
use App\AllocationNotice;
use App\Services\AllocationNoticeService;

class NoticeAllocationsController extends Controller
{
    
    public function store(Request $request, Notice $notice)
    {
        $input = $request->only(
            'amount',
            'allocation_id'
        );

        // Fixme: temp solution / prevent user from attaching same allocation to fix this
        $notice->allocations()->attach($input['allocation_id'], ['amount' => $input['amount']]);
        $allocation = $notice->allocations()
            ->wherePivot('allocation_id', $input['allocation_id'])
            ->first()->pivot;
        return response()->json($allocation);
    }

    public function update(Request $request, Notice $notice)
    {
        $id = $request->get('pk');
        $name = $request->get('name');
        $value = $request->get('value');

        $allocation[$name] = is_array($value) ? $value[0]:$value;
        $notice->allocations()->updateExistingPivot($id, $allocation);


        return response()->json($allocation);
    }

    public function delete(AllocationNotice $noticeAllocation)
    {
        AllocationNoticeService::delete($noticeAllocation);
        return response()->json($noticeAllocation);
    }
}