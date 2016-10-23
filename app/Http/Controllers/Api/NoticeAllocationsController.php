<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\AuthLogsRepository;
use App\Http\Controllers\Controller;
use App\Notice;
use App\NoticeAllocation;
use App\Repositories\NoticeAllocationsRepository;

class NoticeAllocationsController extends Controller
{
    
    public function store(Request $request, Notice $notice)
    {
        $input = $request->only(
            'amount',
            'allocation_id'
        );

        // Fixme: temp solution
        $allocation = $notice->allocations()->attach($input['allocation_id'], ['amount' => $input['amount']]);
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

    public function delete(NoticeAllocation $noticeAllocation)
    {
        NoticeAllocationsRepository::delete($noticeAllocation);
        return response()->json($noticeAllocation);
    }
}