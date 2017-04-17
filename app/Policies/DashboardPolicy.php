<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DashboardPolicy
{
    use HandlesAuthorization;

    public function index(User $user)
    {
        return $user->hasPermission('access:administration');
    }

    public function portfolio(User $user)
    {
        return $user->hasPermission('dashboard:portfolio');
    }

    public function tender(User $user)
    {
        return $user->hasPermission('dashboard:portfolio');
    }

    public function transaction(User $user)
    {
        return $user->hasPermission('dashboard:transaction');
    }

    public function user(User $user)
    {
        return true;
        return $user->hasPermission('dashboard:user');
    }

    public function vendor(User $user)
    {
        return true;
        return $user->hasPermission('dashboard:vendor');
    }
}