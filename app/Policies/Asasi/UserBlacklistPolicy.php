<?php

namespace App\Policies\Asasi;

use App\User;
use App\UserBlacklist;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class UserBlacklistPolicy
 * @package App\Policies
 */
class UserBlacklistPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $auth
     * @return bool
     */
    public function index(User $auth)
    {
        return $auth->hasPermission('user-blacklist:index');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function show(User $auth)
    {
        return $auth->hasPermission('user-blacklist:show');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function create(User $auth)
    {
        return $auth->hasPermission('user-blacklist:create');
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
     * @param UserBlacklist $blacklist
     * @return bool
     */
    public function edit(User $auth, UserBlacklist $blacklist)
    {
        return $auth->hasPermission('user-blacklist:update');
    }

    /**
     * @param User $auth
     * @param UserBlacklist $blacklist
     * @return bool
     */
    public function update(User $auth, UserBlacklist $blacklist)
    {
        return $this->edit($blacklist);
    }

    /**
     * @param User $auth
     * @param UserBlacklist $blacklist
     * @return bool
     */
    public function destroy(User $auth, UserBlacklist $blacklist)
    {
        return $auth->hasPermission('user-blacklist:delete');
    }

    /**
     * @param User $auth
     * @param UserBlacklist $blacklist
     * @return bool
     */
    public function restore(User $auth, UserBlacklist $blacklist)
    {
        return $auth->hasPermission('user-blacklist:restore');
    }

    /**
     * @param User $auth
     * @param UserBlacklist $blacklist
     * @return bool
     */
    public function revisions(User $auth, UserBlacklist $blacklist)
    {
        return $auth->hasPermission('user-blacklist:revisions');
    }

    /**
     * @param User $auth
     * @param UserBlacklist $blacklist
     * @return bool
     */
    public function histories(User $auth, UserBlacklist $blacklist)
    {
        return $auth->hasPermission('user-blacklist:histories');
    }

    /**
     * @param User $auth
     * @param UserBlacklist $blacklist
     * @return bool
     */
    public function archives(User $auth, UserBlacklist $blacklist)
    {
        return $auth->hasPermission('user-blacklist:archives');
    }

    /**
     * @param User $auth
     * @param UserBlacklist $blacklist
     * @return bool
     */
    public function duplicate(User $auth, UserBlacklist $blacklist)
    {
        return $auth->hasPermission('user-blacklist:duplicate');
    }
}
