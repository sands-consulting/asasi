<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function index()
    {
        $notifications = auth()->user()->notifications;
        return view('notifications.index', compact('notifications'));
    }

    public function show(Notification $notification)
    {
        return view('notifications.show', compact('notification'));
    }
}
