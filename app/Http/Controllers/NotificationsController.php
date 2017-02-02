<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
	public function index(Request $request)
	{
		$notifications = $request->user()->notifications()->get();
		return view('notifications.index', compact('notifications'));
	}

	public function show(Request $request, Notification $notification)
	{
		if(empty($notification->unread))
		{
			$notification->read();
		}

		return redirect($notification->link);
	}
}
