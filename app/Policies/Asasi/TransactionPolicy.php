<?php

namespace App\Policies\Asasi;

use App\Transaction;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionPolicy
{
    use HandlesAuthorization;

    public function index(User $auth)
    {
        return $auth->hasPermission('transaction:index');
    }

    public function create(User $auth)
    {
        return $auth->hasPermission('transaction:create');
    }

    public function store(User $auth)
    {
        return $this->create($auth);
    }

    public function edit(User $auth, Transaction $txn)
    {
        return $auth->hasPermission('transaction:update');
    }

    public function update(User $auth, Transaction $txn)
    {
        return $this->edit($auth, $txn);
    }

    public function duplicate(User $auth, Transaction $txn)
    {
        return $auth->hasPermission('transaction:duplicate');
    }

    public function revisions(User $auth, Transaction $txn)
    {
        return $auth->hasPermission('transaction:revisions');
    }

    public function destroy(User $auth, Transaction $txn)
    {
        return $auth->hasPermission('transaction:delete') && !is_null($txn->deleted_at);
    }

    public function restore(User $auth, Transaction $txn)
    {
        return $auth->hasPermission('transaction:restore') && !is_null($txn->deleted_at);
    }

    public function histories(User $auth, Transaction $txn)
    {
        return $auth->hasPermission('transaction:histories');
    }

    public function paid(User $auth, Transaction $txn)
    {
        return $auth->hasPermission('transaction:paid') && empty($txn->invoice_number);
    }

    public function cancel(User $auth, Transaction $txn)
    {
        return $auth->hasPermission('transaction:cancel');
    }

    public function refund(User $auth, Transaction $txn)
    {
        return $auth->hasPermission('transaction:refund');
    }

    public function query(User $auth, Transaction $txn)
    {
        return $auth->hasPermission('transaction:query');
    }
}