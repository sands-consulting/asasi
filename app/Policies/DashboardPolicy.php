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

    public function user(User $user)
    {
        return $user->hasPermission('dashboard:user');
    }

    public function vendor(User $user)
    {
        return $user->hasPermission('dashboard:vendor');
    }

    public function notice(User $user)
    {
        return $user->hasPermission('dashboard:notice');
    }

    public function portfolio(User $user)
    {
        return $user->hasPermission('dashboard:portfolio');
    }

    public function transaction(User $user)
    {
        return $user->hasPermission('dashboard:transaction');
    }
}