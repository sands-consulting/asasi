<?php

namespace App\Policies;

use App\Rule;

class RulesPolicy extends BasePolicy
{
    public function index()
    {
        return $this->user->hasPermission('rule:index');
    }

    public function show()
    {
        return $this->user->hasPermission('rule:show');
    }

    public function create()
    {
        return $this->user->hasPermission('rule:create');
    }

    public function store()
    {
        return $this->create();
    }

    public function edit(Rule $rule)
    {
        return $this->user->hasPermission('rule:update');
    }

    public function update(Rule $rule)
    {
        return $this->edit($rule);
    }

    public function duplicate(Rule $rule)
    {
        return $this->user->hasPermission('rule:duplicate');
    }

    public function revisions(Rule $rule)
    {
        return $this->user->hasPermission('rule:revisions');
    }

    public function destroy(Rule $rule)
    {
        return $this->user->hasPermission('rule:delete');
    }
}