<?php

namespace App\Listeners;

use App\User;
use App\Repositories\UserLogsRepository;
use Illuminate\Http\Request;

class UserLogin
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle($event)
    {
    	$user = $this->request->session()->has('original_user_id') ?
    				User::find($this->request->session()->get('original_user_id')) :
    				$event->user;
        UserLogsRepository::log($event->user, 'login', $user, $this->request->getClientIp());
    }
}
