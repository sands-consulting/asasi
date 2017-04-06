<?php

namespace App\Policies;

use App\TaxCode;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class TaxCodePolicy
 * @package App\Policies
 */
class TaxCodePolicy
{
    use HandlesAuthorization;

    /**
     * @param User $auth
     * @return bool
     */
    public function index(User $auth)
    {
        return $auth->hasPermission('tax-code:index');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function show(User $auth, TaxCode $code)
    {
        return $auth->hasPermission('tax-code:show');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function create(User $auth)
    {
        return $auth->hasPermission('tax-code:create');
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
     * @param TaxCode $code
     * @return bool
     */
    public function edit(User $auth, TaxCode $code)
    {
        return $auth->hasPermission('tax-code:update');
    }

    /**
     * @param User $auth
     * @param TaxCode $code
     * @return bool
     */
    public function update(User $auth, TaxCode $code)
    {
        return $this->edit($auth, $code);
    }

    /**
     * @param User $auth
     * @param TaxCode $code
     * @return bool
     */
    public function destroy(User $auth, TaxCode $code)
    {
        return $auth->hasPermission('tax-code:delete');
    }

    /**
     * @param User $auth
     * @param TaxCode $code
     * @return bool
     */
    public function restore(User $auth, TaxCode $code)
    {
        return $auth->hasPermission('tax-code:restore');
    }

    /**
     * @param User $auth
     * @param TaxCode $code
     * @return bool
     */
    public function revisions(User $auth, TaxCode $code)
    {
        return $auth->hasPermission('tax-code:revisions');
    }

    /**
     * @param User $auth
     * @param TaxCode $code
     * @return bool
     */
    public function histories(User $auth, TaxCode $code)
    {
        return $auth->hasPermission('tax-code:histories');
    }

    /**
     * @param User $auth
     * @param TaxCode $code
     * @return bool
     */
    public function archives(User $auth, TaxCode $code)
    {
        return $auth->hasPermission('tax-code:archives');
    }

    /**
     * @param User $auth
     * @param TaxCode $code
     * @return bool
     */
    public function duplicate(User $auth, TaxCode $code)
    {
        return $auth->hasPermission('tax-code:duplicate');
    }
}
