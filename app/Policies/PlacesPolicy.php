<?php

namespace App\Policies;

use App\Place;

class PlacesPolicy extends BasePolicy
{
    public function index()
    {
        return $this->user->hasPermission('place:index');
    }

    public function show()
    {
        return $this->user->hasPermission('place:show');
    }

    public function create()
    {
        return $this->user->hasPermission('place:create');
    }

    public function store()
    {
        return $this->create();
    }

    public function edit(Place $place)
    {
        return $this->user->hasPermission('place:update');
    }

    public function update(Place $place)
    {
        return $this->edit($place);
    }

    public function destroy(Place $place)
    {
        return $this->user->hasPermission('place:delete');
    }

    public function duplicate(Place $place)
    {
        return $this->user->hasPermission('place:duplicate');
    }

    public function revisions(Place $place)
    {
        return $this->user->hasPermission('place:revisions');
    }

    public function logs(Place $place)
    {
        return $this->user->hasPermission('place:logs');
    }

    public function activate(Place $place)
    {
        return $this->user->hasPermission('place:activate') && $place->canActivate();
    }

    public function deactivate(Place $place)
    {
        return $this->user->hasPermission('place:deactivate') && $place->canDeactivate();
    }
}
