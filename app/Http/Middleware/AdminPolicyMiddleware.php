<?php

namespace App\Http\Middleware;

use Closure;

class AdminPolicyMiddleware extends PolicyMiddleware
{
    protected $redirectTo = 'admin';
}
