<?php

namespace App\Listeners;

use Illuminate\Http\Request;

class UserLogin
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle($event)
    {
        AuthLogsRepository::log($user, 'login', $this->request->getClientIp());
    }
}
