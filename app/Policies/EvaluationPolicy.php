<?php

namespace App\Policies;

use App\Evaluation;
use App\Submission;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class EvaluationPolicy
 * @package App\Policies
 */
class EvaluationPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $auth
     * @return bool
     */
    public function index(User $auth)
    {
        return $auth->hasPermission('evaluation:index');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function show(User $auth, Evaluation $evaluation)
    {
        return $auth->hasPermission('evaluation:show');
    }

    /**
     * @param User $auth
     * @param Evaluation $evaluation
     * @param Evaluation|Submission $evaluation
     * @return bool
     */
    public function edit(User $auth, Evaluation $evaluation, Submission $evaluation)
    {
        return $auth->hasPermission('evaluation:update');
    }

    /**
     * @param User $auth
     * @param Evaluation $evaluation
     * @return bool
     */
    public function update(User $auth, Evaluation $evaluation, Submission $submission)
    {
        return $this->edit($auth, $evaluation, $submission);
    }

    /**
     * @param User $auth
     * @param Evaluation $evaluation
     * @return bool
     */
    public function revisions(User $auth, Evaluation $evaluation)
    {
        return $auth->hasPermission('evaluation:revisions');
    }

    /**
     * @param User $auth
     * @param Evaluation $evaluation
     * @return bool
     */
    public function histories(User $auth, Evaluation $evaluation)
    {
        return $auth->hasPermission('evaluation:histories');
    }
}
