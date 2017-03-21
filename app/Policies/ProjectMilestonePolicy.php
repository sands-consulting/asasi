<?php

namespace App\Policies;

use App\Project;
use App\ProjectMilestone;

class ProjectMilestonePolicy
{
    public function index()
    {
        return $this->user->hasPermission('project-milestone:index');
    }

    public function show(Project $project, ProjectMilestone $projectMilestone)
    {
        return $this->checkOrganization($projectMilestone, 'project-milestone:show');
    }

    public function create()
    {
        return $this->user->hasPermission('project-milestone:create');
    }

    public function createByNotice()
    {
        return $this->create();
    }

    public function store()
    {
        return $this->create();
    }

    public function edit(ProjectMilestone $projectMilestone)
    {
        return $this->checkOrganization($projectMilestone, 'project-milestone:update');
    }

    public function update(ProjectMilestone $projectMilestone)
    {
        return $this->edit($projectMilestone);
    }

    public function destroy(ProjectMilestone $projectMilestone)
    {
        return $this->checkOrganization($projectMilestone, 'project-milestone:delete');
    }

    public function duplicate(ProjectMilestone $projectMilestone)
    {
        return $this->checkOrganization($projectMilestone, 'project-milestone:duplicate');
    }

    public function revisions(ProjectMilestone $projectMilestone)
    {
        return $this->checkOrganization($projectMilestone, 'project-milestone:revisions');
    }

    public function logs(ProjectMilestone $projectMilestone)
    {
        return $this->checkOrganization($projectMilestone, 'project-milestone:logs');
    }

    public function activate(ProjectMilestone $projectMilestone)
    {
        return $this->checkOrganization($projectMilestone, 'project-milestone:activate') && $projectMilestone->canActivate();
    }

    public function deactivate(ProjectMilestone $projectMilestone)
    {
        return $this->checkOrganization($projectMilestone, 'project-milestone:deactivate') && $projectMilestone->canDeactivate();
    }

    protected function checkOrganization(ProjectMilestone $projectMilestone, $permission)
    {
        if(!$this->user->hasPermission($permission))
        {
            return false;
        }

        if($this->user->hasPermission('project-milestone:organization'))
        {
            return $this->user->organizations->pluck('id')->has($projectMilestone->organization_id);
        }

        return true;
    }

    public function ganttData()
    {
        return true;
        return $this->index();
    }
}
