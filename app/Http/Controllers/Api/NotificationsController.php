<?php

namespace App\Http\Controllers\Api;

use App\Notification;
use App\Http\Controllers\Controller;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function index(Request $request)
    {

        $notifications = $request->user()->unreadNotifications;

        if (! empty($notifications)) {
            $notifications->map(function($notification) {
                $notification->created_at_human = $notification->created_at->diffForHumans();
                return $notification;
            });
        }

        return response()->json($notifications);
    }
    
    public function read(Request $request)
    {
        $notification = DatabaseNotification::find($request->get('id'))->markAsRead();
        return response()->json($notification);
    }
    
}