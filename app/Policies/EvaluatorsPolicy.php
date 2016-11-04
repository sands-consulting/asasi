<?php

namespace App\Policies;

use App\Evaluation;
use App\NoticeEValuator;
use App\Notice;

class EvaluatorsPolicy extends BasePolicy
{
    public function index()
    {
        return $this->user->hasPermission('evaluator:index');
    }

    public function create()
    {
        return $this->user->hasPermission('evaluator:create');
    }

    public function edit()
    {
        return $this->user->hasPermission('evaluator:edit');
    }

    public function update()
    {
        return $this->user->hasPermission('evaluator:update');
    }

    public function assign()
    {
        return $this->user->hasPermission('evaluator:index');
    }

    public function assigned()
    {
        return $this->user->hasPermission('evaluator:index');
    }

    public function save()
    {
        return $this->user->hasPermissions(['evaluator:create', 'evaluator:update']);
    }

    public function request(NoticeEvaluator $evaluator)
    {
        return $this->user->id == $evaluator->user_id;
    }

    public function accept(NoticeEvaluator $evaluator)
    {
        return $this->request($evaluator);
    }

    public function decline(NoticeEvaluator $evaluator)
    {
        return $this->request($evaluator);
    }
}