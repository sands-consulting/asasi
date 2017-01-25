<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\AuthLogsService;
use App\Http\Controllers\Controller;
use App\Notice;
use App\Services\NoticesService;

class NoticesController extends Controller
{
    
    public function save(Request $request, Notice $notice)
    {
        $input = $request->only(
            'id',
            'name',
            'number',
            'description',
            'rules',
            'price',
            'published_at',
            'expired_at',
            'purchased_at',
            'submission_at',
            'submission_address',
            'notice_type_id',
            'notice_category_id',
            'organization_id'
        );

        if (isset($input['id'])) {
            $record = Notice::find($input['id']);
            $notice = NoticesService::update($record, $input);
        } else {
            $notice = NoticesService::create(new Notice, $input);
        }

        return response()->json($notice);
    }

    public function update(Request $request, Notice $notice)
    {
        $input = $request->only(
            'id',
            'name',
            'number',
            'description',
            'rules',
            'price',
            'published_at',
            'expired_at',
            'purchased_at',
            'submission_at',
            'submission_address',
            'notice_type_id',
            'notice_category_id',
            'organization_id'
        );

        $notice = NoticesService::update($notice, $input);

        return response()->json($notice);

    }
}