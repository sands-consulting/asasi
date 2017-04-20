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
        return response()->json($request->user()->unreadNotifications);
    }
    
    public function read(Request $request)
    {
    	$notification = DatabaseNotification::find($request->route('notification'))->markAsRead();
        return response()->json($notification);
    }
    
}