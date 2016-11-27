<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Http\Requests;

class NotificationsController extends Controller
{
    public function index(User $user)
    {
        return view('notifications.index');
    }
}
