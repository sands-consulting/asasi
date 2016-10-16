<?php

namespace App\Policies;

use App\Evaluation;
use App\Notice;

class EvaluatorsPolicy extends BasePolicy
{
    public function index()
    {
        return $this->user->hasPermission('evaluator:index');
    }

    public function assign()
    {
        return $this->user->hasPermission('evaluator:index');
    }

    public function assigned()
    {
        return $this->user->hasPermission('evaluator:index');
    }
}