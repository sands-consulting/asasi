<?php

namespace App\Policies;

use App\Notice;

class NoticesPolicy extends BasePolicy
{
    public function index(User $auth)
    {
    	return true;
    }

    public function show(User $auth)
    {
    	return true;
    }
}