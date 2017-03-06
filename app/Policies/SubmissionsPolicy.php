<?php

namespace App\Policies;

use App\Submission;

class SubmissionsPolicy
{
    public function index()
    {
        return $this->user->hasPermission('notice-type:index');
    }

    public function pluck()
    {
        return $this->user->hasPermission('notice-type:show');
    }

    public function show()
    {
        return $this->user->hasPermission('notice-type:show');
    }

    public function create()
    {
        return $this->user->hasPermission('notice-type:create');
    }

    public function store()
    {
        return $this->create();
    }

    public function edit(Submission $submission)
    {
        return $this->user->hasPermission('notice-type:update');
    }

    public function update(Submission $submission)
    {
        return $this->edit($submission);
    }

    public function duplicate(Submission $submission)
    {
        return $this->user->hasPermission('notice-type:duplicate');
    }

    public function revisions(Submission $submission)
    {
        return $this->user->hasPermission('notice-type:revisions');
    }

    public function destroy(Submission $submission)
    {
        return $this->user->hasPermission('notice-type:delete');
    }

    public function activate(Submission $submission)
    {
        return $this->user->hasPermission('notice-type:activate') && $submission->canActivate();
    }

    public function deactivate(Submission $submission)
    {
        return $this->user->hasPermission('notice-type:deactivate') && $submission->canDeactivate();
    }

    public function evaluate(Submission $submission)
    {
        return $this->user->hasPermission('notice-type:create');
    }
}