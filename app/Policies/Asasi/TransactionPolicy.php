<?php

namespace App\Policies\Asasi;

use App\User;
use App\Transaction;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class TransactionPolicy
 * @package App\Policies
 */
class TransactionPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $auth
     * @return bool
     */
    public function index(User $auth)
    {
        return $auth->hasPermission('transaction:index');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function show(User $auth)
    {
        return $auth->hasPermission('transaction:show');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function create(User $auth)
    {
        return $auth->hasPermission('transaction:create');
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
     * @param Transaction $txn
     * @return bool
     */
    public function edit(User $auth, Transaction $txn)
    {
        return $auth->hasPermission('transaction:update');
    }

    /**
     * @param User $auth
     * @param Transaction $txn
     * @return bool
     */
    public function update(User $auth, Transaction $txn)
    {
        return $this->edit($txn);
    }

    /**
     * @param User $auth
     * @param Transaction $txn
     * @return bool
     */
    public function destroy(User $auth, Transaction $txn)
    {
        return $auth->hasPermission('transaction:delete') && !is_null($txn->deleted_at);
    }

    /**
     * @param User $auth
     * @param Transaction $txn
     * @return bool
     */
    public function restore(User $auth, Transaction $txn)
    {
        return $auth->hasPermission('transaction:restore') && !is_null($txn->deleted_at);
    }

    /**
     * @param User $auth
     * @param Transaction $txn
     * @return bool
     */
    public function revisions(User $auth, Transaction $txn)
    {
        return $auth->hasPermission('transaction:revisions');
    }

    /**
     * @param User $auth
     * @param Transaction $txn
     * @return bool
     */
    public function histories(User $auth, Transaction $txn)
    {
        return $auth->hasPermission('transaction:histories');
    }

    /**
     * @param User $auth
     * @param Transaction $txn
     * @return bool
     */
    public function archives(User $auth, Transaction $txn)
    {
        return $auth->hasPermission('transaction:archives');
    }

    /**
     * @param User $auth
     * @param Transaction $txn
     * @return bool
     */
    public function duplicate(User $auth, Transaction $txn)
    {
        return $auth->hasPermission('transaction:duplicate');
    }

    /**
     * @param User $auth
     * @param Transaction $txn
     * @return bool
     */
    public function paid(User $auth, Transaction $txn)
    {
        return $auth->hasPermission('transaction:paid') && empty($txn->invoice_number);
    }

    /**
     * @param User $auth
     * @param Transaction $txn
     * @return bool
     */
    public function cancel(User $auth, Transaction $txn)
    {
        return $auth->hasPermission('transaction:cancel');
    }

    /**
     * @param User $auth
     * @param Transaction $txn
     * @return bool
     */
    public function refund(User $auth, Transaction $txn)
    {
        return $auth->hasPermission('transaction:refund');
    }

    /**
     * @param User $auth
     * @param Transaction $txn
     * @return bool
     */
    public function query(User $auth, Transaction $txn)
    {
        return $auth->hasPermission('transaction:query');
    }
}
