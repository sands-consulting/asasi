<?php

namespace App\Policies\Asasi;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class MePolicy
 * @package App\Policies
 */
class MePolicy
{
    use HandlesAuthorization;

    /**
     * @param User $auth
     * @return bool
     */
    public function edit(User $auth)
    {
        return $auth->exists();
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function update(User $auth)
    {
        return $auth->exists();
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function resume(User $auth)
    {
        return app('session')->has('resume_user_id');
    }
}
