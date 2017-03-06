<?php

namespace App\Policies;

use App\RequirementTechnical;

class RequirementTechnicalsPolicy
{
    public function index()
    {
        return $this->user->hasPermission('requirement-technical:index');
    }

    public function show()
    {
        return $this->user->hasPermission('requirement-technical:show');
    }

    public function create()
    {
        return $this->user->hasPermission('requirement-technical:create');
    }

    public function store()
    {
        return $this->create();
    }

    public function edit(RequirementTechnical $requirementTechnical)
    {
        return $this->user->hasPermission('requirement-technical:update');
    }

    public function update(RequirementTechnical $requirementTechnical)
    {
        return $this->edit($requirementTechnical);
    }

    public function duplicate(RequirementTechnical $requirementTechnical)
    {
        return $this->user->hasPermission('requirement-technical:duplicate');
    }

    public function revisions(RequirementTechnical $requirementTechnical)
    {
        return $this->user->hasPermission('requirement-technical:revisions');
    }

    public function destroy(RequirementTechnical $requirementTechnical)
    {
        return $this->user->hasPermission('requirement-technical:delete');
    }
}