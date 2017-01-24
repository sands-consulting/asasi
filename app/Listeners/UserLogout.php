<?php

namespace App\Listeners;

use App\Services\UserHistoryService;
use Illuminate\Http\Request;

class UserLogout
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle($event)
    {
        UserHistoryService::log($event->user, 'logout', $this->request->user(), $this->request->getClientIp());
    }
}
