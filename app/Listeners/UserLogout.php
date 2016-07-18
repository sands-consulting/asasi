<?php

namespace App\Listeners;

use Illuminate\Http\Request;

class UserLogout
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle($event)
    {
        AuthLogsRepository::log($user, 'logout', $this->request->getClientIp());
    }
}
