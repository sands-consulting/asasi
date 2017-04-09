<?php

namespace App\Policies\Asasi;

use App\PaymentGateway;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class PaymentGatewayPolicy
 * @package App\Policies
 */
class PaymentGatewayPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $auth
     * @return bool
     */
    public function index(User $auth)
    {
        return $auth->hasPermission('payment-gateway:index');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function show(User $auth)
    {
        return $auth->hasPermission('payment-gateway:show');
    }

    /**
     * @param User $auth
     * @return bool
     */
    public function create(User $auth)
    {
        return $auth->hasPermission('payment-gateway:create');
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
     * @param PaymentGateway $gateway
     * @return bool
     */
    public function edit(User $auth, PaymentGateway $gateway)
    {
        return $auth->hasPermission('payment-gateway:update');
    }

    /**
     * @param User $auth
     * @param PaymentGateway $gateway
     * @return bool
     */
    public function update(User $auth, PaymentGateway $gateway)
    {
        return $this->edit($auth, $gateway);
    }

    /**
     * @param User $auth
     * @param PaymentGateway $gateway
     * @return bool
     */
    public function destroy(User $auth, PaymentGateway $gateway)
    {
        return $auth->hasPermission('payment-gateway:delete') && !is_null($gateway->deleted_at);
    }

    /**
     * @param User $auth
     * @param PaymentGateway $gateway
     * @return bool
     */
    public function restore(User $auth, PaymentGateway $gateway)
    {
        return $auth->hasPermission('payment-gateway:restore') && !is_null($gateway->deleted_at);
    }

    /**
     * @param User $auth
     * @param PaymentGateway $gateway
     * @return bool
     */
    public function revisions(User $auth, PaymentGateway $gateway)
    {
        return $auth->hasPermission('payment-gateway:revisions');
    }

    /**
     * @param User $auth
     * @param PaymentGateway $gateway
     * @return bool
     */
    public function histories(User $auth, PaymentGateway $gateway)
    {
        return $auth->hasPermission('payment-gateway:histories');
    }

    /**
     * @param User $auth
     * @param PaymentGateway $gateway
     * @return bool
     */
    public function archives(User $auth, PaymentGateway $gateway)
    {
        return $auth->hasPermission('payment-gateway:archives');
    }

    /**
     * @param User $auth
     * @param PaymentGateway $gateway
     * @return bool
     */
    public function duplicate(User $auth, PaymentGateway $gateway)
    {
        return $auth->hasPermission('payment-gateway:duplicate');
    }
}
