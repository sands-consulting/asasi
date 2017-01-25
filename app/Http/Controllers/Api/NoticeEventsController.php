<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\AuthLogsService;
use App\Http\Controllers\Controller;
use App\Notice;
use App\NoticeEvent;
use App\Services\NoticeEventsService;

class NoticeEventsController extends Controller
{
    
    public function store(Request $request, Notice $notice)
    {
        $inputs = $request->only(
            'name',
            'notice_event_type_id',
            'location',
            'event_at',
            'required'
        );

        // Fixme: temp solution
        $inputs['required'] = $inputs['required'][0];
        $inputs['notice_id'] = $notice->id;
        $noticeEvent = NoticeEventsService::create(new NoticeEvent, $inputs);

        return response()->json($noticeEvent);
    }

    public function update(Request $request)
    {
        $id = $request->get('pk');
        $name = $request->get('name');
        $value = $request->get('value');

        $noticeEvent = NoticeEvent::find($id);
        $noticeEvent->$name = is_array($value) ? $value[0]:$value;
        $noticeEvent->save();

        return response()->json($noticeEvent);
    }

    public function delete(NoticeEvent $noticeEvent)
    {
        NoticeEventsService::delete($noticeEvent);
        return response()->json($noticeEvent);
    }
}