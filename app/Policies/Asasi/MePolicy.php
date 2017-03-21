<?php

namespace App\Policies\Asasi;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MePolicy
{
    use HandlesAuthorization;

    public function edit(User $auth)
    {
        return $auth->exists();
    }

    public function update(User $auth)
    {
        return $auth->exists();
    }

    public function resume(User $auth)
    {
        return app('session')->has('resume_user_id');
    }
}
