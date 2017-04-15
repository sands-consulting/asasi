<?php

namespace App\Policies;

use App\Project;
use App\ProjectMilestone;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectMilestonePolicy
{
    use HandlesAuthorization;

    public function show(User $user, Project $project, ProjectMilestone $projectMilestone)
    {
        return $this->checkOrganization($projectMilestone, 'project-milestone:show');
    }

    protected function checkOrganization(User $auth, ProjectMilestone $projectMilestone, $permission)
    {
        if (! $auth->hasPermission($permission)) {
            return false;
        }

        if ($auth->hasPermission('project-milestone:organization')) {
            return $auth->organizations->pluck('id')->has($projectMilestone->organization_id);
        }

        return true;
    }

    public function createByNotice(User $auth)
    {
        return $this->create($auth);
    }

    public function create(User $auth)
    {
        return $auth->hasPermission('project-milestone:create');
    }

    public function store(User $auth)
    {
        return $this->create($auth);
    }

    public function update(User $auth, ProjectMilestone $projectMilestone)
    {
        return $this->edit($auth, $projectMilestone);
    }

    public function edit(User $auth, ProjectMilestone $projectMilestone)
    {
        return $this->checkOrganization($projectMilestone, 'project-milestone:update');
    }

    public function destroy(User $auth, ProjectMilestone $projectMilestone)
    {
        return $this->checkOrganization($projectMilestone, 'project-milestone:delete');
    }

    public function duplicate(User $auth, ProjectMilestone $projectMilestone)
    {
        return $this->checkOrganization($projectMilestone, 'project-milestone:duplicate');
    }

    public function revisions(User $auth, ProjectMilestone $projectMilestone)
    {
        return $this->checkOrganization($projectMilestone, 'project-milestone:revisions');
    }

    public function logs(User $auth, ProjectMilestone $projectMilestone)
    {
        return $this->checkOrganization($projectMilestone, 'project-milestone:logs');
    }

    public function activate(User $auth, ProjectMilestone $projectMilestone)
    {
        return $this->checkOrganization($projectMilestone,
                'project-milestone:activate') && $projectMilestone->canActivate();
    }

    public function deactivate(User $auth, ProjectMilestone $projectMilestone)
    {
        return $this->checkOrganization($projectMilestone,
                'project-milestone:deactivate') && $projectMilestone->canDeactivate();
    }

    public function ganttData(User $auth)
    {
        return true;
        return $this->index($auth);
    }

    public function index(User $auth)
    {
        return $auth->hasPermission('project-milestone:index');
    }
}
