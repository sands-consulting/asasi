<?php

namespace App\Policies\Asasi;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class SettingPolicy
 * @package App\Policies
 */
class SettingPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $auth
     * @return bool
     */
    public function edit(User $auth)
    {
        return $auth->hasPermission('access:settings');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function update(User $auth)
    {
        return $this->edit($auth);
    }
}
