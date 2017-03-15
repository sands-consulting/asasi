<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function index(User $auth)
    {
        return $auth->hasPermission('user:index');
    }

    public function create(User $auth)
    {
        return $auth->hasPermission('user:create');
    }

    public function store(User $auth)
    {
        return $this->create($auth);
    }

    public function show(User $auth, User $user)
    {
        return $auth->hasPermission('user:show');
    }

    public function edit(User $auth, User $user)
    {
        return $auth->hasPermission('user:edit');
    }

    public function update(User $auth, User $user)
    {
        return $auth->edit($auth, $user);
    }

    public function destroy(User $auth, User $user)
    {
        return $auth->hasPermission('user:delete');
    }

    public function restore(User $auth, User $user)
    {
        return $auth->hasPermission('user:restore');
    }

    public function histories(User $auth, User $user)
    {
        return $auth->hasPermission('user:histories');
    }

    public function revisions(User $auth, User $user)
    {
        return $auth->hasPermission('user:revisions');
    }

    public function activate(User $auth, User $user)
    {
        return $auth->hasPermission('user:activate');
    }

    public function suspend(User $auth, User $user)
    {
        return $auth->hasPermission('user:suspend');
    }

    public function assume(User $auth, User $user)
    {
        return $auth->hasPermission('user:assume');
    }

    public function resume(User $auth, User $user)
    {
        return app('session')->has('resume_user_id');
    }

    public function archives(User $auth)
    {
        return $auth->hasPermission('user:suspend');
    }
}
