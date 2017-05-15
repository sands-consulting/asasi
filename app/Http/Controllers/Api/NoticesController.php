<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\AuthLogsService;
use App\Http\Controllers\Controller;
use App\Notice;
use App\Services\NoticesService;

class NoticesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('data')) {
            $data = $request->get('data');

            if (isset($data['id'])) {
                $notices = Notice::whereId($data['id'])->get();
            } else {
                $notices = Notice::published()->get();
            }

            if (isset($data['columns'])) {
                $notices = $notices->select($data['columns']);   
            }
        } else {
            $notices = Notice::published()->get();
        }

        return response()->json($notices);
    }

    public function eligibles(Request $request)
    {
        $user = $request->user();
        $notices = Notice::published()
            ->whereHas('eligibles', function($query) use ($user) {
                $query->where('vendor_id', $user->vendor->id);
            })->get();

        return response()->json($notices);
    }

    public function purchases(Request $request)
    {
        $user = $request->user();
        $notices = Notice::published()
            ->whereHas('purchases', function($query) use ($user) {
                $query->where('vendor_id', $user->vendor->id);
            })
            ->with('organization')
            ->get();

        return response()->json($notices);
    }

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
