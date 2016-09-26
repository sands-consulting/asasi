<?php

namespace App\Policies;

use App\Evaluation;

class EvaluationsPolicy extends BasePolicy
{
    public function evaluate()
    {
        return $this->user->hasPermission('evaluation:evaluate');
    }
}