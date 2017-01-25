<?php 

namespace App\Services;

use App\User;
use App\UserHistory;
use Sands\Asasi\Service as BaseService;

class UserHistoryService extends BaseService
{
    public static function log(User $user, $action, $item, $ip_address, $remarks = '')
    {
        static::create(new UserHistory, [
            'user_id' => $user->id,
            'action' => $action,
            'actionable_id' => $item->id,
            'actionable_type' => get_class($item),
            'ip_address' => $ip_address,
            'remarks' => $remarks,
        ]);
    }
}