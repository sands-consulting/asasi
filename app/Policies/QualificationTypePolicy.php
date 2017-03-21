<?php

namespace App\Policies;

use App\User;
use App\QualificationType;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class QualificationTypePolicy
 * @package App\Policies
 */
class QualificationTypePolicy
{
    use HandlesAuthorization;

    /**
     * @param User $auth
     * @return bool
     */
    public function index(User $auth)
    {
        return $auth->hasPermission('qualification-type:index');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function show(User $auth)
    {
        return $auth->hasPermission('qualification-type:show');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function create(User $auth)
    {
        return $auth->hasPermission('qualification-type:create');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function store(User $auth)
    {
        return $this->create($auth);
    }

    /**
     * @param User $auth
     * @param QualificationType $type
     * @return bool
     */
    public function edit(User $auth, QualificationType $type)
    {
        return $auth->hasPermission('qualification-type:update');
    }

    /**
     * @param User $auth
     * @param QualificationType $type
     * @return bool
     */
    public function update(User $auth, QualificationType $type)
    {
        return $this->edit($type);
    }

    /**
     * @param User $auth
     * @param QualificationType $type
     * @return bool
     */
    public function destroy(User $auth, QualificationType $type)
    {
        return $auth->hasPermission('qualification-type:delete');
    }

    /**
     * @param User $auth
     * @param QualificationType $type
     * @return bool
     */
    public function restore(User $auth, QualificationType $type)
    {
        return $auth->hasPermission('qualification-type:restore');
    }

    /**
     * @param User $auth
     * @param QualificationType $type
     * @return bool
     */
    public function revisions(User $auth, QualificationType $type)
    {
        return $auth->hasPermission('qualification-type:revisions');
    }

    /**
     * @param User $auth
     * @param QualificationType $type
     * @return bool
     */
    public function histories(User $auth, QualificationType $type)
    {
        return $auth->hasPermission('qualification-type:histories');
    }

    /**
     * @param User $auth
     * @param QualificationType $type
     * @return bool
     */
    public function archives(User $auth, QualificationType $type)
    {
        return $auth->hasPermission('qualification-type:archives');
    }

    /**
     * @param User $auth
     * @param QualificationType $type
     * @return bool
     */
    public function duplicate(User $auth, QualificationType $type)
    {
        return $auth->hasPermission('qualification-type:duplicate');
    }
}
