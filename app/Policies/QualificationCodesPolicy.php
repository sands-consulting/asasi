<?php

namespace App\Policies;

class QualificationCodesPolicy
{
    public function index()
    {
        return $this->user->hasPermission('qualification-code:index');
    }

    public function show()
    {
        return $this->user->hasPermission('qualification-code:show');
    }

    public function create()
    {
        return $this->user->hasPermission('qualification-code:create');
    }

    public function store()
    {
        return $this->create();
    }

    public function edit()
    {
        return $this->user->hasPermission('qualification-code:update');
    }

    public function update()
    {
        return $this->edit();
    }

    public function destroy()
    {
        return $this->user->hasPermission('qualification-code:delete');
    }

    public function duplicate()
    {
        return $this->user->hasPermission('qualification-code:duplicate');
    }

    public function revisions()
    {
        return $this->user->hasPermission('qualification-code:revisions');
    }

    public function logs()
    {
        return $this->user->hasPermission('qualification-code:logs');
    }
}