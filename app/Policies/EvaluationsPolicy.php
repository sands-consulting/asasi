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

    public function create()
    {
        return $this->user->hasPermission('evaluation:create');
    }

    public function store()
    {
        return $this->user->hasPermission('evaluation:store');
    }

    public function edit()
    {
        return $this->user->hasPermission('evaluation:edit');
    }

    public function update()
    {
        return $this->user->hasPermission('evaluation:update');
    }
}