<?php

namespace App\Libraries\Policy;

use App\User;
use Illuminate\Auth\AuthManager;

class BasePolicy
{
    public function __construct(AuthManager $auth)
    {
        $this->auth    = $auth;
        $this->user    = $this->auth->check() ? $this->auth->user() : new User();
    }
}
