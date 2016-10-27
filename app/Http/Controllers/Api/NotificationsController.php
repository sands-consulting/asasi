<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\AuthLogsRepository;
use App\Http\Controllers\Controller;
use App\Notification;
use App\Repositories\NotificationsRepository;

class NotificationsController extends Controller
{
    public function index(Request $request)
    {
        $notifications = Notification::whereUserId($request->user()->id)
            ->status($request->get('status'))
            ->get();

        $notifications = $notifications->each(function($notification) {
            $notification->created_at_human = $notification->created_at->diffForHumans();
            return $notification;
        });

        return $notifications;
    }
}