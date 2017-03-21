<?php

namespace App\Policies;

use App\User;
use App\QualificationCode;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class QualificationCodePolicy
 * @package App\Policies
 */
class QualificationCodePolicy
{
    use HandlesAuthorization;

    /**
     * @param User $auth
     * @return bool
     */
    public function index(User $auth)
    {
        return $auth->hasPermission('qualification-code:index');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function show(User $auth)
    {
        return $auth->hasPermission('qualification-code:show');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function create(User $auth)
    {
        return $auth->hasPermission('qualification-code:create');
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
     * @param QualificationCode $code
     * @return bool
     */
    public function edit(User $auth, QualificationCode $code)
    {
        return $auth->hasPermission('qualification-code:update');
    }

    /**
     * @param User $auth
     * @param QualificationCode $code
     * @return bool
     */
    public function update(User $auth, QualificationCode $code)
    {
        return $this->edit($code);
    }

    /**
     * @param User $auth
     * @param QualificationCode $code
     * @return bool
     */
    public function destroy(User $auth, QualificationCode $code)
    {
        return $auth->hasPermission('qualification-code:delete');
    }

    /**
     * @param User $auth
     * @param QualificationCode $code
     * @return bool
     */
    public function restore(User $auth, QualificationCode $code)
    {
        return $auth->hasPermission('qualification-code:restore');
    }

    /**
     * @param User $auth
     * @param QualificationCode $code
     * @return bool
     */
    public function revisions(User $auth, QualificationCode $code)
    {
        return $auth->hasPermission('qualification-code:revisions');
    }

    /**
     * @param User $auth
     * @param QualificationCode $code
     * @return bool
     */
    public function histories(User $auth, QualificationCode $code)
    {
        return $auth->hasPermission('qualification-code:histories');
    }

    /**
     * @param User $auth
     * @param QualificationCode $code
     * @return bool
     */
    public function archives(User $auth, QualificationCode $code)
    {
        return $auth->hasPermission('qualification-code:archives');
    }

    /**
     * @param User $auth
     * @param QualificationCode $code
     * @return bool
     */
    public function duplicate(User $auth, QualificationCode $code)
    {
        return $auth->hasPermission('qualification-code:duplicate');
    }
}
