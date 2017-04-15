<?php

namespace App\Policies;

use App\User;
use Cart;

class CartPolicy
{
    public function index(User $auth)
    {
        return $auth->hasPermission('access:vendor');
    }

    public function checkout(User $auth)
    {
        return $auth->hasPermission('access:vendor') && Cart::count() > 0;
    }

    public function destroy(User $auth)
    {
        return $auth->hasPermission('access:vendor') && Cart::count() > 0;
    }

    public function add(User $auth)
    {
        return $auth->hasPermission('access:vendor');
    }

    public function remove(User $auth)
    {
        return $auth->hasPermission('access:vendor');
    }
}