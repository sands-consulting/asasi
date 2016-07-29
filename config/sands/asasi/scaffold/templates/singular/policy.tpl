<?php

namespace App\Policies;

use App\ModelName;

class ModelNamesPolicy extends BasePolicy
{
    public function index()
    {
        return $this->user->hasPermission('model-name:index');
    }

    public function show()
    {
        return $this->user->hasPermission('model-name:show');
    }

    public function create()
    {
        return $this->user->hasPermission('model-name:create');
    }

    public function store()
    {
        return $this->create();
    }

    public function edit(ModelName $modelName)
    {
        return $this->user->hasPermission('model-name:update');
    }

    public function update(ModelName $modelName)
    {
        return $this->edit($modelName);
    }

    public function destroy(ModelName $modelName)
    {
        return $this->user->hasPermission('model-name:delete');
    }

    public function duplicate(ModelName $modelName)
    {
        return $this->user->hasPermission('model-name:duplicate');
    }

    public function revisions(ModelName $modelName)
    {
        return $this->user->hasPermission('model-name:revisions');
    }

    public function logs(ModelName $modelName)
    {
        return $this->user->hasPermission('model-name:logs');
    }

    public function activate(ModelName $modelName)
    {
        return $this->user->hasPermission('model-name:activate') && $modelName->canActivate();
    }

    public function deactivate(ModelName $modelName)
    {
        return $this->user->hasPermission('model-name:deactivate') && $modelName->canDeactivate();
    }
}
