<?php

namespace App\Policies;

use App\Evaluation;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EvaluationPolicy
{
    use HandlesAuthorization;

    public function index(User $auth)
    {
        return $auth->hasPermission('evaluation:index');
    }

    public function submission(User $auth)
    {
        return $auth->hasPermission('evaluation:submission');
    }
    
    public function view(User $auth)
    {
        return true;
    }

    public function edit(User $auth)
    {
        return $auth->hasPermission('evaluation:update');
    }

    public function update(User $auth)
    {
        return $this->edit($auth);
    }
}