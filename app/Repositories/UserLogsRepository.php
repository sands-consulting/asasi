<?php 

namespace App\Repositories;

use App\UserLog;
use App\User;

class UserLogsRepository extends BaseRepository
{
    public static function log(User $user, $action, $ip=null)
    {
        static::create(new UserLog, [
            'user_id' => $user->id,
            'ip_address' => $ip,
            'action' => $action
        ]);
    }
}