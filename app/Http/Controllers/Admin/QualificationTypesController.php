<?php

namespace App\Http\Controllers\Admin;

use App\QualificationType;
use App\DataTables\QualificationTypeDataTable;
use App\DataTables\RevisionsDataTable;
use App\DataTables\UserHistoriesDataTable;
use App\Http\Requests\QualificationTypeRequest;
use App\Services\QualificationTypeService;
use App\Services\UserHistoryService;
use Illuminate\Http\Request;

class QualificationTypesController extends Controller
{
    public function index(Request $request, QualificationTypeDataTable $table)
    {
        return $table->render('admin.qualification-types.index');
    }

    public function create(Request $request)
    {
        return view('admin.qualification-types.create', ['type' => new QualificationType]);
    }

    public function store(QualificationTypeRequest $request)
    {
        $type = QualificationTypeService::create(new QualificationType, $request->only('name', 'type', 'code', 'status'));

        if($request->input('parent_id', null) && $request->input('parent_id') != $type->parent_id)
        {
            $type->makeChildOf(QualificationType::find($request->input('parent_id')));
        }
        else
        {
            $type->makeRoot();
        }

        UserHistoryService::log($request->user(), 'create', $type, $request->getClientIp());
        return redirect()
            ->route('admin.qualification-types.index')
            ->with('notice', trans('qualification-types.notices.created', ['name' => $type->name]));
    }

    public function edit(QualificationType $type)
    {
        return view('admin.qualification-types.edit', compact('type'));
    }

    public function update(QualificationTypeRequest $request, QualificationType $type)
    {
        $type = QualificationTypeService::update($type, $request->only('name', 'type', 'code', 'status'));

        if($request->input('parent_id', null) && $request->input('parent_id') != $type->parent_id)
        {
            $type->makeChildOf(QualificationType::find($request->input('parent_id')));
        }
        else if($type->isChild())
        {
            $type->makeRoot();
        }

        UserHistoryService::log($request->user(), 'update', $type, $request->getClientIp());
        return redirect()
            ->route('admin.qualification-types.index')
            ->with('notice', trans('qualification-types.notices.updated', ['name' => $type->name]));
    }

    public function destroy(Request $request, QualificationType $type)
    {
        QualificationTypeService::delete($type);
        UserHistoryService::log($request->user(), 'delete', $type, $request->getClientIp());
        return redirect()
            ->route('admin.qualification-types.index')
            ->with('alert', trans('qualification-types.notices.deleted', ['name' => $type->name]));
    }

    public function histories(QualificationType $type, UserHistoriesDataTable $table)
    {
        $table->setActionable($type);
        return $table->render('admin.qualification-types.histories', compact('type'));
    }

    public function revisions(QualificationType $type, RevisionsDataTable $table)
    {
        $table->setRevisionable($type);
        return $table->render('admin.qualification-types.revisions', compact('type'));
    }
}
