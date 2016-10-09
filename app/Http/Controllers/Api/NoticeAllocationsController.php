<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\AuthLogsRepository;
use App\Http\Controllers\Controller;
use App\NoticeAllocation;
use App\Repositories\NoticeAllocationsRepository;

class NoticeAllocationsController extends Controller
{
    
    public function store(Request $request, NoticeAllocation $noticeEvent)
    {
        $inputs = $request->only(
            'amount',
            'allocation_id',
            'notice_id'
        );

        // Fixme: temp solution
        $inputs['required'] = $inputs['required'][0];
        $noticeEvent = NoticeAllocationsRepository::create(new NoticeAllocation, $inputs);

        return response()->json($noticeEvent);
    }

    public function update(Request $request)
    {
        $id = $request->get('pk');
        $name = $request->get('name');
        $value = $request->get('value');

        $noticeEvent = NoticeAllocation::find($id);
        $noticeEvent->$name = is_array($value) ? $value[0]:$value;
        $noticeEvent->save();

        return response()->json($noticeEvent);
    }

    public function delete(NoticeAllocation $noticeEvent)
    {
        NoticeAllocationsRepository::delete($noticeEvent);
        return response()->json($noticeEvent);
    }
}