<?php

namespace App\Policies;

class QualificationTypesPolicy
{
    public function index()
    {
        return $this->user->hasPermission('qualification-code-type:index');
    }

    public function show()
    {
        return $this->user->hasPermission('qualification-code-type:show');
    }

    public function create()
    {
        return $this->user->hasPermission('qualification-code-type:create');
    }

    public function store()
    {
        return $this->create();
    }

    public function edit()
    {
        return $this->user->hasPermission('qualification-code-type:update');
    }

    public function update()
    {
        return $this->edit();
    }

    public function destroy()
    {
        return $this->user->hasPermission('qualification-code-type:delete');
    }

    public function duplicate()
    {
        return $this->user->hasPermission('qualification-code-type:duplicate');
    }

    public function revisions()
    {
        return $this->user->hasPermission('qualification-code-type:revisions');
    }

    public function logs()
    {
        return $this->user->hasPermission('qualification-code-type:logs');
    }
}