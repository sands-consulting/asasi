<?php

namespace App\Listeners;

use App\Repositories\UserLogsRepository;
use Illuminate\Http\Request;

class UserLogout
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle($event)
    {
        UserLogsRepository::log($event->user, 'logout', $this->request->getClientIp());
    }
}
