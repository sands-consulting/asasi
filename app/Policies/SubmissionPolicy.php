<?php

namespace App\Policies;

use App\Submission;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class SubmissionPolicy
 * @package App\Policies
 */
class SubmissionPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $auth
     * @return bool
     */
    public function index(User $auth)
    {
        return $auth->hasPermission('submission:index');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function show(User $auth)
    {
        return $auth->hasPermission('submission:show');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function create(User $auth)
    {
        return $auth->hasPermission('submission:create');
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
     * @param Submission $place
     * @return bool
     */
    public function edit(User $auth, Submission $place)
    {
        return $auth->hasPermission('submission:update');
    }

    /**
     * @param User $auth
     * @param Submission $place
     * @return bool
     */
    public function update(User $auth, Submission $place)
    {
        return $this->edit($place);
    }

    /**
     * @param User $auth
     * @param Submission $place
     * @return bool
     */
    public function destroy(User $auth, Submission $place)
    {
        return $auth->hasPermission('submission:delete');
    }

    /**
     * @param User $auth
     * @param Submission $place
     * @return bool
     */
    public function restore(User $auth, Submission $place)
    {
        return $auth->hasPermission('submission:restore');
    }

    /**
     * @param User $auth
     * @param Submission $place
     * @return bool
     */
    public function revisions(User $auth, Submission $place)
    {
        return $auth->hasPermission('submission:revisions');
    }

    /**
     * @param User $auth
     * @param Submission $place
     * @return bool
     */
    public function histories(User $auth, Submission $place)
    {
        return $auth->hasPermission('submission:histories');
    }

    /**
     * @param User $auth
     * @param Submission $place
     * @return bool
     */
    public function archives(User $auth, Submission $place)
    {
        return $auth->hasPermission('submission:archives');
    }

    /**
     * @param User $auth
     * @param Submission $place
     * @return bool
     */
    public function duplicate(User $auth, Submission $place)
    {
        return $auth->hasPermission('submission:duplicate');
    }
}
