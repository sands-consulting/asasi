<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\AuthLogsRepository;
use App\Http\Controllers\Controller;
use App\NoticeEvent;
use App\Repositories\NoticeEventsRepository;

class NoticeEventsController extends Controller
{
    
    public function store(Request $request, NoticeEvent $noticeEvent)
    {
        $inputs = $request->only(
            'name',
            'notice_event_type_id',
            'location',
            'event_at',
            'required',
            'notice_id'
        );

        // Fixme: temp solution
        $inputs['required'] = $inputs['required'][0];
        $noticeEvent = NoticeEventsRepository::create(new NoticeEvent, $inputs);

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
        NoticeEventsRepository::delete($noticeEvent);
        return response()->json($noticeEvent);
    }
}