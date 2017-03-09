<?php

namespace App\Policies;

use App\User;

class QualificationCodesPolicy
{
    public function index(User $user)
    {
        return $user->hasPermission('qualification-code:index');
    }

    public function show(User $user)
    {
        return $user->hasPermission('qualification-code:show');
    }

    public function create(User $user)
    {
        return $user->hasPermission('qualification-code:create');
    }

    public function store(User $user)
    {
        return $this->create($user);
    }

    public function edit(User $user)
    {
        return $user->hasPermission('qualification-code:update');
    }

    public function update(User $user)
    {
        return $this->edit($user);
    }

    public function destroy(User $user)
    {
        return $user->hasPermission('qualification-code:delete');
    }

    public function duplicate(User $user)
    {
        return $user->hasPermission('qualification-code:duplicate');
    }

    public function revisions(User $user)
    {
        return $user->hasPermission('qualification-code:revisions');
    }

    public function logs(User $user)
    {
        return $user->hasPermission('qualification-code:logs');
    }
}