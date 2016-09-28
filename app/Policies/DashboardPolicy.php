<?php

namespace App\Policies;

class DashboardPolicy extends BasePolicy
{
    public function index()
    {
        return true;
        // return $this->user->hasPermission('dashboard:index');
    }
}