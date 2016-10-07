<?php

namespace App\Policies;

class DashboardPolicy extends BasePolicy
{
    public function index()
    {
        return true;
        // return $this->user->hasPermission('dashboard:index');
    }

    public function user()
    {
        return true;
    }

    public function vendor()
    {
        return true;
    }

    public function transaction()
    {
        return true;
    }

    public function portfolio()
    {
        return true;
    }

    public function tender()
    {
        return true;
    }
}