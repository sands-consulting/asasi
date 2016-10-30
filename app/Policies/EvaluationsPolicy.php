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
        return $this->user->hasPermission('evaluation:evaluate');
    }

    public function create()
    {
        return $this->submission();
    }

    public function store()
    {
        return $this->submission();
    }

    public function edit()
    {
        return $this->submission();
    }

    public function update()
    {
        return $this->submission();
    }
}