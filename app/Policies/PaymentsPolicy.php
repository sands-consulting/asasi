<?php

namespace App\Policies;

use App\Payment;

class PaymentsPolicy extends BasePolicy
{
    public function index()
    {
        return $this->user->hasPermission('payment:index');
    }

    public function show()
    {
        return $this->user->hasPermission('payment:show');
    }

    public function create()
    {
        return $this->user->hasPermission('payment:create');
    }

    public function store()
    {
        return $this->create();
    }

    public function edit(Payment $payment)
    {
        return $this->user->hasPermission('payment:update');
    }

    public function update(Payment $payment)
    {
        return $this->edit($payment);
    }

    public function duplicate(Payment $payment)
    {
        return $this->user->hasPermission('payment:duplicate');
    }

    public function revisions(Payment $payment)
    {
        return $this->user->hasPermission('payment:revisions');
    }

    public function destroy(Payment $payment)
    {
        return $this->user->hasPermission('payment:delete');
    }

    public function activate(Payment $payment)
    {
        return $this->user->hasPermission('payment:activate') && $payment->canActivate();
    }

    public function deactivate(Payment $payment)
    {
        return $this->user->hasPermission('payment:deactivate') && $payment->canDeactivate();
    }
}