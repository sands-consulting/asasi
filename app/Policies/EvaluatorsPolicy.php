<?php

namespace App\Policies;

use App\Evaluation;
use App\NoticeEValuator;
use App\Notice;
use App\User;

class EvaluatorsPolicy
{
    public function index(User $auth)
    {
        return $auth->hasPermission('evaluator:index');
    }

    public function create(User $auth)
    {
        return $auth->hasPermission('evaluator:create');
    }

    public function edit(User $auth)
    {
        return $auth->hasPermission('evaluator:edit');
    }

    public function update(User $auth)
    {
        return $this->edit($auth);
    }

    public function assign(User $auth)
    {
        return $auth->hasPermission('evaluator:index');
    }

    public function assigned(User $auth)
    {
        return $auth->hasPermission('evaluator:index');
    }

    public function save(User $auth)
    {
        return $auth->hasPermissions(['evaluator:create', 'evaluator:update']);
    }

    public function request(User $auth, NoticeEvaluator $evaluator)
    {
        return $auth->id == $evaluator->user_id;
    }

    public function accept(User $auth, NoticeEvaluator $evaluator)
    {
        return $this->request($auth, $evaluator);
    }

    public function decline(User $auth, NoticeEvaluator $evaluator)
    {
        return $this->request($auth, $evaluator);
    }
}