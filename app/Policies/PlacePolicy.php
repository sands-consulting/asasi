<?php

namespace App\Policies;

use App\Place;
use App\User;

class PlacePolicy
{
    public function index(User $user)
    {
        return $user->hasPermission('place:index');
    }

    public function show(User $user)
    {
        return $user->hasPermission('place:show');
    }

    public function create(User $user)
    {
        return $user->hasPermission('place:create');
    }

    public function store(User $user)
    {
        return $this->create($user);
    }

    public function edit(User $user, Place $place)
    {
        return $user->hasPermission('place:update');
    }

    public function update(User $user, Place $place)
    {
        return $this->edit($user, $place);
    }

    public function destroy(User $user, Place $place)
    {
        return $user->hasPermission('place:delete');
    }

    public function duplicate(User $user, Place $place)
    {
        return $user->hasPermission('place:duplicate');
    }

    public function revisions(User $user, Place $place)
    {
        return $user->hasPermission('place:revisions');
    }

    public function logs(User $user, Place $place)
    {
        return $user->hasPermission('place:logs');
    }

    public function activate(User $user, Place $place)
    {
        return $user->hasPermission('place:activate') && $place->canActivate();
    }

    public function deactivate(User $user, Place $place)
    {
        return $user->hasPermission('place:deactivate') && $place->canDeactivate();
    }
}
