<?php

namespace App\Policies;

use App\User;

class UsersPolicy extends BasePolicy
{
    public function index()
    {
        return $this->user->hasPermission('user:index');
    }

    public function archives()
    {
        return $this->index();
    }

    public function show()
    {
        return $this->user->hasPermission('user:show');
    }

    public function create()
    {
        return $this->user->hasPermission('user:create');
    }

    public function store()
    {
        return $this->create();
    }

    public function edit(User $user)
    {
        return $this->user->hasPermission('user:update');
    }

    public function update(User $user)
    {
        return $this->edit($user);
    }

    public function destroy(User $user)
    {
        return $this->user->hasPermission('user:delete') && $this->user->id != $user->id;
    }

    public function duplicate(User $user)
    {
        return $this->user->hasPermission('user:duplicate');
    }

    public function revisions(User $user)
    {
        return $this->user->hasPermission('user:revisions');
    }

    public function logs(User $user)
    {
        return $this->user->hasPermission('user:logs');
    }

    public function assume(User $user)
    {
        return $this->user->hasPermission('user:assume');
    }

    public function activate(User $user)
    {
        return $this->user->hasPermission('user:activate') && $user->canActivate();
    }

    public function suspend(User $user)
    {
        return $this->user->hasPermission('user:suspend') && $user->canSuspend();
    }

    public function restore(User $user)
    {
        return true;
    }
}
