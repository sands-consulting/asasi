<?php

namespace App\Http\Controllers;

use App\ModelName;
use App\DataTables\ModelNamesDataTable;
use App\DataTables\RevisionsDataTable;
use App\Http\Requests\ModelNameRequest;
use App\Repositories\ModelNamesRepository;
use Illuminate\Http\Request;

class ModelNamesController extends Controller
{
    public function index(ModelNamesDataTable $table)
    {
        return $table->render('model-names.index');
    }

    public function create(Request $request)
    {
        return view('model-names.create', ['modelNames' => new ModelName]);
    }

    public function store(ModelNameRequest $request)
    {
        $inputs = $request->only('name', 'code_2', 'code_3', 'type', 'parent_id');
        $modelName  = ModelNamesRepository::create(new ModelName, $inputs);
        return redirect()
            ->route('model-names.show', $modelName->id)
            ->with('notice', trans('model-names.notices.created', ['name' => $modelName->name]));
    }

    public function show(ModelName $modelName)
    {
        return view('model-names.show', compact('modelNames'));
    }

    public function edit(ModelName $modelName)
    {
        return view('model-names.edit', compact('modelNames'));
    }

    public function update(ModelNameRequest $request, ModelName $modelName)
    {
        $inputs = $request->only('name', 'code_2', 'code_3', 'type', 'parent_id');
        $modelName  = ModelNamesRepository::update($modelName, $inputs);
        return redirect()
            ->route('model-names.show', $modelName->id)
            ->with('notice', trans('model-names.notices.updated', ['name' => $modelName->name]));
    }

    public function destroy(ModelName $modelName)
    {
        ModelNamesRepository::delete($modelName);
        return redirect()
            ->route('model-names.index')
            ->with('notice', trans('model-names.notices.deleted', ['name' => $modelName->name]));
    }

    public function logs(ModelName $modelName, ModelNameLogsDataTable $table)
    {
        $table->setActionable($modelName);
        return $table->render('model-names.logs', compact('modelNames'));
    }

    public function revisions(ModelName $modelName, RevisionsDataTable $table)
    {
        $table->setRevisionable($modelName);
        return $table->render('model-names.revisions', compact('modelNames'));
    }

    public function activate(Request $request, ModelName $modelName)
    {
        ModelNamesRepository::activate($modelName);
        return redirect()
            ->to($request->input('redirect_to', route('model-names.show', $modelName->id)))
            ->with('notice', trans('model-names.notices.activated', ['name' => $modelName->name]));
    }

    public function deactivate(Request $request, ModelName $modelName)
    {
        ModelNamesRepository::deactivate($modelName);
        return redirect()
            ->to($request->input('redirect_to', route('model-names.show', $modelName->id)))
            ->with('notice', trans('model-names.notices.deactivated', ['name' => $modelName->name]));
    }
}
