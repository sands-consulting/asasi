<?php

namespace App\Policies;

use App\Evaluation;
use App\Notice;

class EvaluationRequirementsPolicy
{
    public function index()
    {
        return $this->user->hasPermission('evaluation:index');
    }

    public function create(Notice $notice)
    {
        return $this->user->hasPermission('evaluation:index');
    }

    public function edit(Notice $requirement)
    {
        return $this->user->hasPermission('evaluation:index');
    }
}