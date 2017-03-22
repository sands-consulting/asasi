<?php

namespace App\Policies\Asasi;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class UserPolicy
 * @package App\Policies
 */
class UserPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $auth
     * @return bool
     */
    public function index(User $auth)
    {
        return $auth->hasPermission('user:index');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function show(User $auth)
    {
        return $auth->hasPermission('user:show');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function create(User $auth)
    {
        return $auth->hasPermission('user:create');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function store(User $auth)
    {
        return $this->create($auth);
    }

    /**
     * @param User $auth
     * @param User $user
     * @return bool
     */
    public function edit(User $auth, User $user)
    {
        return $auth->hasPermission('user:update');
    }

    /**
     * @param User $auth
     * @param User $user
     * @return bool
     */
    public function update(User $auth, User $user)
    {
        return $this->edit($user);
    }

    /**
     * @param User $auth
     * @param User $user
     * @return bool
     */
    public function destroy(User $auth, User $user)
    {
        return $auth->hasPermission('user:delete');
    }

    /**
     * @param User $auth
     * @param User $user
     * @return bool
     */
    public function restore(User $auth, User $user)
    {
        return $auth->hasPermission('user:restore');
    }

    /**
     * @param User $auth
     * @param User $user
     * @return bool
     */
    public function revisions(User $auth, User $user)
    {
        return $auth->hasPermission('user:revisions');
    }

    /**
     * @param User $auth
     * @param User $user
     * @return bool
     */
    public function histories(User $auth, User $user)
    {
        return $auth->hasPermission('user:histories');
    }

    /**
     * @param User $auth
     * @param User $user
     * @return bool
     */
    public function archives(User $auth, User $user)
    {
        return $auth->hasPermission('user:archives');
    }

    /**
     * @param User $auth
     * @param User $user
     * @return bool
     */
    public function activate(User $auth, User $user)
    {
        return $auth->hasPermission('user:duplicate') 
                && $user->status != 'active';
    }

    /**
     * @param User $auth
     * @param User $user
     * @return bool
     */
    public function suspend(User $auth, User $user)
    {
        return $auth->hasPermission('user:histories')
                && $user->status != 'suspended';
    }

    /**
     * @param User $auth
     * @param User $user
     * @return bool
     */
    public function assume(User $auth, User $user)
    {
        return $auth->hasPermission('user:assume');
    }

    /**
     * @param User $auth
     * @param User $user
     * @return bool
     */
    public function resume(User $auth, User $user)
    {
        return app('session')->has('resume_user_id');
    }
}
