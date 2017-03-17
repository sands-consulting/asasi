<?php

namespace App\Policies;

use App\Evaluation;
use App\Notice;
use App\User;

class EvaluationRequirementsPolicy
{
    public function index(User $auth)
    {
        return $auth->hasPermission('evaluation:index');
    }

    public function create(User $auth, Notice $notice)
    {
        return $auth->hasPermission('evaluation:index');
    }

    public function edit(User $auth, Notice $notice)
    {
        return $auth->hasPermission('evaluation:index');
    }
}