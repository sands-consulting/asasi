<?php

namespace App\Policies;

use App\Project;

class ProjectsPolicy
{
    public function index()
    {
        return $this->user->hasPermission('project:index');
    }

    public function show(Project $project)
    {
        return $this->checkOrganization($project, 'project:show');
    }

    public function create()
    {
        return $this->user->hasPermission('project:create');
    }

    public function createByNotice()
    {
        return $this->create();
    }

    public function store()
    {
        return $this->create();
    }

    public function edit(Project $project)
    {
        return $this->checkOrganization($project, 'project:update');
    }

    public function update(Project $project)
    {
        return $this->edit($project);
    }

    public function destroy(Project $project)
    {
        return $this->checkOrganization($project, 'project:delete');
    }

    public function duplicate(Project $project)
    {
        return $this->checkOrganization($project, 'project:duplicate');
    }

    public function revisions(Project $project)
    {
        return $this->checkOrganization($project, 'project:revisions');
    }

    public function logs(Project $project)
    {
        return $this->checkOrganization($project, 'project:logs');
    }

    public function activate(Project $project)
    {
        return $this->checkOrganization($project, 'project:activate') && $project->canActivate();
    }

    public function deactivate(Project $project)
    {
        return $this->checkOrganization($project, 'project:deactivate') && $project->canDeactivate();
    }

    protected function checkOrganization(Project $project, $permission)
    {
        if(!$this->user->hasPermission($permission))
        {
            return false;
        }

        if($this->user->hasPermission('project:organization'))
        {
            return $this->user->organizations->pluck('id')->has($project->organization_id);
        }

        return true;
    }
}
