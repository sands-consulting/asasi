<?php 

namespace App\Repositories;

use App\AuthLog;
use App\User;

class AuthLogsRepository extends BaseRepository
{
    public static function log(User $user, $action, $ip=null)
    {
        static::create(new AuthLog, [
            'user_id' => $user->id,
            'ip_address' => $ip
            'action' => $action
        ]);
    }
}