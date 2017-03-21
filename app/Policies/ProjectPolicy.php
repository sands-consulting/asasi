<?php

namespace App\Policies;

use App\Project;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class ProjectsPolicy
 * @package App\Policies
 */
class ProjectPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $auth
     * @return bool
     */
    public function index(User $auth)
    {
        return $auth->hasPermission('project:index');
    }

    /**
     * @param User $auth
     * @param Project $project
     * @return bool
     */
    public function show(User $auth, Project $project)
    {
        return $this->checkOrganization($auth, $project, 'project:show');
    }

    /**
     * @param User $auth
     * @return mixed
     */
    public function create(User $auth)
    {
        return $auth->hasPermission('project:create');
    }

    /**
     * @param User $auth
     * @return mixed
     */
    public function store(User $auth)
    {
        return $this->create($auth);
    }

    /**
     * @param User $auth
     * @param Project $project
     * @return bool
     */
    public function edit(User $auth, Project $project)
    {
        return $this->checkOrganization($auth, $project, 'project:update');
    }

    /**
     * @param User $auth
     * @param Project $project
     * @return bool
     */
    public function update(User $auth, Project $project)
    {
        return $this->edit($auth, $project);
    }

    /**
     * @param User $auth
     * @param Project $project
     * @return bool
     */
    public function destroy(User $auth, Project $project)
    {
        return $this->checkOrganization($auth, $project, 'project:delete');
    }

    /**
     * @param User $auth
     * @param Project $project
     * @return bool
     */
    public function restore(User $auth, Project $project)
    {
        return $this->checkOrganization($auth, $project, 'project:restore');
    }

    /**
     * @param User $auth
     * @param Project $project
     * @return bool
     */
    public function revisions(User $auth, Project $project)
    {
        return $this->checkOrganization($auth, $project, 'project:revisions');
    }

    /**
     * @param User $auth
     * @param Project $project
     * @return bool
     */
    public function histories(User $auth, Project $project)
    {
        return $this->checkOrganization($auth, $project, 'project:histories');
    }

    /**
     * @param User $auth
     * @param Project $project
     * @return bool
     */
    public function archives(User $auth, Project $project)
    {
        return $this->checkOrganization($auth, $project, 'project:archives');
    }

    /**
     * @param User $auth
     * @param Project $project
     * @return bool
     */
    public function duplicate(User $auth, Project $project)
    {
        return $this->checkOrganization($auth, $project, 'project:duplicate');
    }

    /**
     * @param User $auth
     * @param Project $project
     * @return bool
     */
    public function activate(User $auth, Project $project)
    {
        return $this->checkOrganization($auth, $project, 'project:activate') && $project->status != 'active';
    }

    /**
     * @param User $auth
     * @param Project $project
     * @return bool
     */
    public function suspend(User $auth, Project $project)
    {
        return $this->checkOrganization($auth, $project, 'project:suspend') && $project->status != 'suspended';
    }

    /**
     * @param User $auth
     * @param Project $project
     * @param $permission
     * @return bool
     */
    protected function checkOrganization(User $auth, Project $project, $permission)
    {
        if ( ! $auth->hasPermission($permission)) {
            return false;
        }

        if ($auth->hasPermission('project:organization')) {
            return $auth->organizations->pluck('id')->has($project->organization_id);
        }

        return true;
    }

    # To Remove

    /**
     * @param User $auth
     * @return mixed
     */
    public function createByNotice(User $auth)
    {
        return $this->create($auth);
    }
}
