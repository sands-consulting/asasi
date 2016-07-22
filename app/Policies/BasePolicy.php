<?php

namespace App\Policies;

use App\User;
use Illuminate\Contracts\Auth\Guard;

class BasePolicy
{
	protected $auth;
	protected $user;

    public function __construct(Guard $auth)
    {
        $this->auth    = $auth;
        $this->user    = $this->auth->check() ? $this->auth->user() : new User();
    }
}
