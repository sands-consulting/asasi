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
        $input['notice_id'] = $notice->id;
        $noticeAllocation = NoticeAllocationsRepository::create(new NoticeAllocation, $input);

        return response()->json($noticeAllocation);
    }

    public function update(Request $request)
    {
        $id = $request->get('pk');
        $name = $request->get('name');
        $value = $request->get('value');

        $noticeAllocation = NoticeAllocation::find($id);
        $noticeAllocation->$name = is_array($value) ? $value[0]:$value;
        $noticeAllocation->save();

        return response()->json($noticeAllocation);
    }

    public function delete(NoticeAllocation $noticeAllocation)
    {
        NoticeAllocationsRepository::delete($noticeAllocation);
        return response()->json($noticeAllocation);
    }
}