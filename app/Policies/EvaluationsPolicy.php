<?php

namespace App\Policies;

use App\Evaluation;

class EvaluationsPolicy extends BasePolicy
{
    public function index()
    {
        return $this->user->hasPermission('evaluation:index');
    }

    public function submissions()
    {
        return $this->user->hasPermission('evaluation:evaluate');
    }

    public function create()
    {
        return $this->submissions();
    }

    public function store()
    {
        return $this->submissions();
    }

    public function edit()
    {
        return $this->submissions();
    }

    public function update()
    {
        return $this->submissions();
    }
}