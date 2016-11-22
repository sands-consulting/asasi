<?php

namespace App\Policies;

use App\Evaluation;

class EvaluationsPolicy extends BasePolicy
{
    public function index()
    {
        return $this->user->hasPermission('evaluation:index');
    }

    public function submission()
    {
        return $this->user->hasPermission('evaluation:submission');
    }
    
    public function view()
    {
        return true;
    }

    public function edit()
    {
        return $this->user->hasPermission('evaluation:update');
    }

    public function update()
    {
        return $this->edit();
    }
}