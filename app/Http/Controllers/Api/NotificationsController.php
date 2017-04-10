<?php

namespace App\Http\Controllers\Api;

use App\Notification;
use App\Http\Controllers\Controller;
use App\Services\NotificationsService;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function index(Request $request)
    {
        $notifications = Notification::whereUserId($request->user()->id)
            ->status($request->input('status'))
            ->orderBy('created_at', 'desc')
            ->get();

        $notifications = $notifications->each(function($notification) {
            $notification->created_at_human = $notification->created_at->diffForHumans();
            return $notification;
        });

        return $notifications;
    }
}