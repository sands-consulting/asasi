<?php 

namespace App\Repositories;

use App\UserLog;
use App\User;

class UserLogsRepository extends BaseRepository
{
    public static function log(User $user, $action, $item, $ip_address, $remarks = '')
    {
        static::create(new UserLog, [
            'user_id' => $user->id,
            'action' => $action,
            'actionable_id' => $item->id,
            'actionable_type' => get_class($item),
            'ip_address' => $ip_address,
            'remarks' => $remarks,
        ]);
    }
}