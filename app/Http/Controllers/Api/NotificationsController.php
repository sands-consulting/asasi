<?php

namespace App\Http\Controllers\Api;

use App\Notification;
use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function index(Request $request)
    {
        $response = false;
        $notifications = Notification::whereUserId($request->user()->id)
            ->status($request->get('status'))
            ->orderBy('created_at', 'desc')
            ->get();

        if (! empty($notifications)) {
            $response = $notifications->each(function($notification) {
                $notification->created_at_human = $notification->created_at->diffForHumans();
                return $notification;
            });
        }

        return response()->json($response);
    }
    
    public function read(Request $request)
    {
        $notification = Notification::find($request->get('id'));
        $notification->read_at = Carbon::now();
        $notification->status = 'read';
        $notification->save();

        return response()->json($notification);
    }
    
}