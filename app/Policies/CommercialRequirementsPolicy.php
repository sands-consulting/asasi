<?php

namespace App\Policies;

use App\CommercialRequirement;

class CommercialRequirementsPolicy
{
    public function index()
    {
        return $this->user->hasPermission('commercial-requirement:index');
    }

    public function show()
    {
        return $this->user->hasPermission('commercial-requirement:show');
    }

    public function create()
    {
        return $this->user->hasPermission('commercial-requirement:create');
    }

    public function store()
    {
        return $this->create();
    }

    public function edit(CommercialRequirement $commercialRequirement)
    {
        return $this->user->hasPermission('commercial-requirement:update');
    }

    public function update(CommercialRequirement $commercialRequirement)
    {
        return $this->edit($commercialRequirement);
    }

    public function duplicate(CommercialRequirement $commercialRequirement)
    {
        return $this->user->hasPermission('commercial-requirement:duplicate');
    }

    public function revisions(CommercialRequirement $commercialRequirement)
    {
        return $this->user->hasPermission('commercial-requirement:revisions');
    }

    public function destroy(CommercialRequirement $commercialRequirement)
    {
        return $this->user->hasPermission('commercial-requirement:delete');
    }

    public function publish(CommercialRequirement $commercialRequirement)
    {
        return $this->user->hasPermission('commercial-requirement:publish') && $commercialRequirement->canPublish();
    }

    public function unpublish(CommercialRequirement $commercialRequirement)
    {
        return $this->user->hasPermission('commercial-requirement:unpublish') && $commercialRequirement->canUnpublish();
    }
}