<?php

namespace App\Policies;

use App\Notice;
use App\User;

class CartPolicy extends BasePolicy
{
    public function index(User $auth)
    {
        return $auth->hasPermission('access:cart');
    }

    public function checkout(User $auth)
    {
        return $auth->hasPermission('access:cart');
    }

    public function destroy(User $auth)
    {
        return $auth->hasPermission('access:cart');
    }

    public function add(User $auth)
    {
        return $auth->hasPermission('access:cart');
    }

    public function remove(User $auth)
    {
        return $auth->hasPermission('access:cart');
    }
}