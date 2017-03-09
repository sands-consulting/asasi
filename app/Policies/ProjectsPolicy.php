<?php

namespace App\Policies;

use App\Project;
use App\User;

/**
 * Class ProjectsPolicy
 * @package App\Policies
 */
class ProjectsPolicy
{
    /**
     * @param User $user
     * @return bool
     */
    public function index(User $user)
    {
        return $user->hasPermission('project:index');
    }

    /**
     * @param User $user
     * @param Project $project
     * @return bool
     */
    public function show(User $user, Project $project)
    {
        return $this->checkOrganization($user, $project, 'project:show');
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermission('project:create');
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function createByNotice(User $user)
    {
        return $this->create($user);
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function store(User $user)
    {
        return $this->create($user);
    }

    /**
     * @param User $user
     * @param Project $project
     * @return bool
     */
    public function edit(User $user, Project $project)
    {
        return $this->checkOrganization($user, $project, 'project:update');
    }

    /**
     * @param User $user
     * @param Project $project
     * @return bool
     */
    public function update(User $user, Project $project)
    {
        return $this->edit($user, $project);
    }

    /**
     * @param User $user
     * @param Project $project
     * @return bool
     */
    public function destroy(User $user, Project $project)
    {
        return $this->checkOrganization($user, $project, 'project:delete');
    }

    /**
     * @param User $user
     * @param Project $project
     * @return bool
     */
    public function duplicate(User $user, Project $project)
    {
        return $this->checkOrganization($user, $project, 'project:duplicate');
    }

    /**
     * @param User $user
     * @param Project $project
     * @return bool
     */
    public function revisions(User $user, Project $project)
    {
        return $this->checkOrganization($user, $project, 'project:revisions');
    }

    /**
     * @param User $user
     * @param Project $project
     * @return bool
     */
    public function logs(User $user, Project $project)
    {
        return $this->checkOrganization($user, $project, 'project:logs');
    }

    /**
     * @param User $user
     * @param Project $project
     * @return bool
     */
    public function activate(User $user, Project $project)
    {
        return $this->checkOrganization($user, $project, 'project:activate') && $project->canActivate();
    }

    /**
     * @param User $user
     * @param Project $project
     * @return bool
     */
    public function deactivate(User $user, Project $project)
    {
        return $this->checkOrganization($user, $project, 'project:deactivate') && $project->canDeactivate();
    }

    /**
     * @param User $user
     * @param Project $project
     * @param $permission
     * @return bool
     */
    protected function checkOrganization(User $user, Project $project, $permission)
    {
        if ( ! $user->hasPermission($permission)) {
            return false;
        }

        if ($user->hasPermission('project:organization')) {
            return $user->organizations->pluck('id')->has($project->organization_id);
        }

        return true;
    }
}
